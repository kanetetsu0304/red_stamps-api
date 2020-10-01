<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedStampBook extends Model
{
    protected $fillable = [
        'user_id', 'sanctuary_id', 'introduce', 'front_image_url','back_image_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sanctuary()
    {
        return $this->belongsTo('App\Sanctuary');
    }
}
