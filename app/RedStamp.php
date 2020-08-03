<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedStamp extends Model
{
    protected $fillable = [
        'user_id', 'sanctuary_id', 'date', 'comment', 'image_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sanctuary()
    {
        return $this->belongsTo('App\Sanctuary');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }
}
