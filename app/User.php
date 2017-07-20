<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'type', 'status','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function myAvatar()
    {
        if(Auth::user()->avatar==null)
        {
            return '/storage/avatars/default-avatar.png';
        }
        else
        {
            return "/storage/".Auth::user()->avatar;
        }
    }
}
