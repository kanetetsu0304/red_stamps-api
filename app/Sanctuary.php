<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanctuary extends Model
{
    protected $fillable = [
        'name','prefecture','city','latitude','longitude'
    ];

    public function red_stamps()
    {
        return $this->hasMany('App\RedStamp');
    }
}
