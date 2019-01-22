<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sender(){
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function markAsRead(){

    }

    public function repliedMessage(){
        return $this->hasOne(Message::class, 'id', 'reply');
    }



}
