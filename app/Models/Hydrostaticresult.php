<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hydrostaticresult extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function itemujiriksa() {
    	return $this->belongsTo('App\Models\Itemujiriksa');
    }
}
