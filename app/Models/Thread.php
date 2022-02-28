<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['sender', 'receiver'];


    public function chats()
    {
        return $this->hasMany('App\Models\Message');
    }

}
