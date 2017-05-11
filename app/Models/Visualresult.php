<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visualresult extends Model
{
    protected $guarded = [];

    public function itemujiriksa() {
    	return $this->belongsTo('App\Models\Itemujiriksa');
    }

    public function fotovisual() {
    	return $this->hasMany('App\Models\Fotovisual');
    }
}
