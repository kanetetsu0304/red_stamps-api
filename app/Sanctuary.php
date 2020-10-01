<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanctuary extends Model
{
    protected $fillable = [
        'name','prefecture_id','city','latitude','longitude'
    ];

    public function red_stamps()
    {
        return $this->hasMany('App\RedStamp');
    }

    public function red_stamp_books()
    {
        return $this->hasOne('App\RedStampBook');
    }

    public function prefecture()
    {
        return $this->belongsTo('App\Prefecture');
    }
}
