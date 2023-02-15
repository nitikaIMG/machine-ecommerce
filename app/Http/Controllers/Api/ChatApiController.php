<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\ChatChannel;
use App\Models\ChatMessage;
use DB, Validator;

class ChatApiController extends ApiController
{
    private $limit = 15;

    public function index()
    {
        $user = $this->user();
        $channels = ChatChannel::where('user_id', $user->id)
            ->orWhereHas('participants', function ($query) use ($user) {
                $query->where('chat_participants.user_id', $user->id);
            })
            ->with(['user', 'participants'])
            ->paginate($this->limit)
            ->through(function ($channel) use ($user) {
                # Get Latest Message
                $message = $channel->messages()->latest()->first();

                # Get participants
                $participants = $channel->participants
                    ->filter(function ($participant) use ($user) {
                        return $participant->id !== $user->id;
                    })->implode('name', ', ');
		       $profile_pic= $channel->participants
                    ->filter(function ($participant) use ($user) {
                        return $participant->id !== $user->id;
                    })->implode('profile_pic', ', ');

                $unread_msg =  ChatMessage::where('chat_channel_id', $channel->id)->where('status', 0)->where('user_id','!=', $user->id)->count();
                $last_msg =  ChatMessage::where('chat_channel_id', $channel->id)->select('message')->latest()->first();
                # Finally Return Data
                return [
                    'id' => $channel->id,
                    'participants' => 'You, ' . $participants,
		            'profile_pic' => $profile_pic, 
                    'unread_msg' => $unread_msg,
                    'last_msg' => (!empty($last_msg))?$last_msg->message:'',
                    'created_at' => $channel->created_at->format('Y-m-d H:i'),
                    'created_at_str' => $channel->created_at->diffForHumans(),
                    'updated_at' => $message && $message->updated_at
                        ? $message->updated_at->format('Y-m-d H:i')
                        : $channel->updated_at->format('Y-m-d H:i'),
                    'updated_at_str' => $message && $message->updated_at
                        ? $message->updated_at->diffForHumans()
                        : $channel->updated_at->diffForHumans(),
                ];
            });
        return ApiResponse::ok(__('Chat Channel List'), $channels);
    }

    public function viewChannel(ChatChannel $channel)
    {
        // TODO: authorize whether this user can see this channel

        $user = $this->user();
        ChatMessage::where('chat_channel_id',$channel->id)->where('user_id','!=',$user->id)->where('status',0)->update(['status'=>'1']);
        $participants = $channel->participants
            ->filter(function ($participant) use ($user) {
                return $participant->id !== $user->id;
            })->implode('name', ', ');

        try {
            $messages = $channel->messages()
                ->with(['user'])
                ->latest()
                ->get()
                // ->reverse()
                ->map(function ($message) use ($user) {

                    return [
                        'message' => [
                            'id' => $message->id,
                            'type' => $message->type ?? 0,
                            'text' => $message->message,
                            'is_mine' => (bool) ($message->user->id === $user->id),
                            'created_at' => $message->created_at->format('Y-m-d H:i'),
                            'created_at_str' => $message->created_at->diffForHumans()
                        ],
                        'user' => [
                            'name' => $message->user->id === $user->id
                                ? __('You')
                                : $message->user->name
                        ]
                    ];
                });

            # Prepare Response Data
            $chat = [
                'participants' => 'You, ' . $participants,
                'messages' => $messages
            ];

            return ApiResponse::ok(__('View Chat Messages'), $chat);
        } catch (Exception $e) {
            logger($e->getMessage());
        }

        return ApiResponse::error(__('Something went wrong!'));
    }

    public function createChannel(Request $request)
    {
        // TODO: Authorize whether this user can initiate chat
        //      with this bidder

        // TODO: if a chat already initiate; redirect to chat screen

        # Validate Input data
        $validator = Validator::make($request->all(), [
            'users' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        # Get Logged In User
        $user = $this->user();
        # Get Participants
        $participants = (array) $request->input('users');

        array_push($participants, $user->id);
        // dd($participants);

        // try to locate the existing channel
        if ($channel = $this->checkForExistingChannel($participants)) {
            return ApiResponse::ok(
                __('Chat Channel Already Exists'),
                ['channel_id' => $channel->id]
            );
        }
        DB::beginTransaction();

        try {

            $channel = $user->chat_channels()
                ->save(new ChatChannel());

            $channel->participants()
                ->attach($participants);

            DB::commit();

            // redirect to chat screen
            return ApiResponse::ok(
                __('Chat Initiated Successfully'),
                ['channel_id' => $channel->id]
            );
        } catch (\Exception $e) {
            logger($e->getMessage());
        }

        DB::rollBack();

        return ApiResponse::error(__('Something went wrong! Please try again.'));
    }

    public function sendMessage(Request $request, ChatChannel $channel)
    {
        // TODO:: authorize whether this user can send message at this channel

        # Validate Input data
        $validator = Validator::make($request->all(), [
            'message' => ['required', 'string'],
            'type' => ['in:0,1,2,3'],
        ]);

        if ($validator->fails()) {
            return $this->validation_error_response($validator);
        }

        try {
            $user = $this->user();
            $type = $request->input('type');
            $message = $user->chat_messages()->create([
                'message' => $request->input('message'),
                'type' => (!empty($type))?$type:0,
                'chat_channel_id' => $channel->id
            ]);

            // emit this message to this channel's subscribers
            broadcast(
                new MessageSent($user, $channel, $message)
            )->toOthers();

            return ApiResponse::ok(__('Message Sent'));
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
        return ApiResponse::error(__('Something went wrong!'));
    }

    private function checkForExistingChannel(array $participants)
    {
         $channels =DB::table('chat_participants')->where('user_id',$participants[0])->get();

        if(isset($channels)){
            foreach($channels as $channel){
                 $children = DB::table('chat_participants')->where('user_id',$participants[1])->where('chat_channel_id',$channel->chat_channel_id)->select('chat_channel_id as id')->first();
                if($children){
                    return $children;
                }
         }
        }
        
        return false;
    }
} // Controller Close 
