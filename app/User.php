<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function red_stamps()
    {
        return $this->hasMany('App\RedStamp');
    }

    public function followings()
    {
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'follow_user_id', 'user_id')->withTimestamps();
    }
}
