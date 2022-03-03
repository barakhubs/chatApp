<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['message'];


    public function messages()
    {
        return $this->belongsTo('App\Models\Message', 'message', 'id');
    }

}
