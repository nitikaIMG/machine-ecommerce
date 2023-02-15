<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
    protected $table = 'chat_channels';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'chat_participants', 'chat_channel_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'chat_channel_id');
    }
}
