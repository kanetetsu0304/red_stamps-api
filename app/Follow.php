<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id', 'follow_user_id'
    ];

    public function followings()
    {
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_user_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'follow_user_id', 'user_id')->withTimestamps();
    }
}
