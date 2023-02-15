<?php

namespace App\Events;

use App\Models\ChatChannel;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user; // who sent the message

    public $message; // the message

    public $channel; // for what channel

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, ChatChannel $channel, ChatMessage $message)
    {
        $this->user = $user;
        $this->message = $message;
        $this->channel = $channel;
    }

    public function broadcastWith()
    {
        $message = $this->message;
        $user = $this->user;

        return [
            'message' => [
                'text' => $message->message,
                'created_at' => $message->created_at->format('Y-m-d H:i'),
                'created_at_dh' => $message->created_at->diffForHumans()
            ],
            'user' => [
                'name' => $user->name
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->channel->id);
    }
}
