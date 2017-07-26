<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable=['message'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
