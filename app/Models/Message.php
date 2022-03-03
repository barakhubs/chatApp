<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['thread', 'sender_id', 'receiver_id', 'message'];


    public function favorite()
    {
        return $this->hasOne('App\Models\Favorite', 'message', 'id');
    }

}
