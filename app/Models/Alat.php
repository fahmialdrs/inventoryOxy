<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $guarded = [];

    public function jenisalat() {
    	return $this->belongsTo('App\Models\Jenisalat');
    }

    public function merk() {
    	return $this->belongsTo('App\Models\Merk');
    }

    public function customer() {
    	return $this->belongsTo('App\Models\Customer');
    }

    public function itemujiriksa() {
        return $this->hasMany('App\Models\Itemujiriksa');
    }
}
