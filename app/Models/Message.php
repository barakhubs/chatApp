<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread', 'sender_id', 'receiver_id', 'message'];


    public function thread()
    {
        return this->belongsTo('App\Models\Thread', 'thread_id', 'id');
    }

}
