<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fototabung extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    
    public function itemujiriksa() {
    	return $this->belongsToMany('App\Models\Itemujiriksa');
    }
}
