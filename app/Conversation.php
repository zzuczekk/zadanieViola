<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function user1(){
        return $this->belongsTo(User::class,'user1');
    }

    public function user2(){
        return $this->belongsTo(User::class,'user2');
    }
    public function messages(){
        return $this->hasMany(Message::class);//->select(['user_id','text','created_at']);
    }
}
