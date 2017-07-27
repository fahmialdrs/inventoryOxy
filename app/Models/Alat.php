<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $guarded = [];
    protected $dates = ['terakhir_service'];

    public function jenisalat() {
    	return $this->belongsTo('App\Models\Jenisalat');
    }

    public function merk() {
    	return $this->belongsTo('App\Models\Merk');
    }

    public function tipe() {
        return $this->belongsTo('App\Models\Tipe');
    }

    public function customer() {
    	return $this->belongsTo('App\Models\Customer');
    }

    public function itemujiriksa() {
        return $this->hasMany('App\Models\Itemujiriksa');
    }
}
