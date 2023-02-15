<?php

use App\Models\ChatChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{channel}', function ($user, $channel) {
    if( $channel = ChatChannel::find($channel)) {
        if( $channel->user_id === $user->id ) {
            return true; 
        }

        // is this user one of the participants
        $existsAsAParticipant =
            $channel->participants()
                ->where('chat_participants.user_id', $user->id)
                ->exists();

        if( $existsAsAParticipant ) {
            return true;
        }
    }

    return false;
});
