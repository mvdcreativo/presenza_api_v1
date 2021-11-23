<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'name', 'email', 'phone', 'message', 'status_id'
    ];


    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
