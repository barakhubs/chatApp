<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['user', 'friend'];


    public function user()
    {
        return $this->belongsTo('App\User', 'friend', 'id');
    }

}
