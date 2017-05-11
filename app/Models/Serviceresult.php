<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serviceresult extends Model
{
    protected $guarded = [];

    public function itemujiriksa() {
    	return $this->belongsTo('App\Models\Itemujiriksa');
    }

    public function fotoservice() {
    	return $this->hasMany('App\Models\Fotoservice');
    }
}
