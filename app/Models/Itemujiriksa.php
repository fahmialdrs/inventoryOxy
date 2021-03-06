<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itemujiriksa extends Model
{
	protected $guarded = [];

	public function formujiriksa() {
    	return $this->belongsTo('App\Models\Formujiriksa');
    }

    public function fototabung() {
    	return $this->hasMany('App\Models\Fototabung');
    }

    public function tube() {
    	return $this->belongsTo('App\Models\Tube');
    }

    public function hydrostaticresult() {
    	return $this->hasOne('App\Models\Hydrostaticresult');
    }

    public function visualresult() {
    	return $this->hasOne('App\Models\Visualresult')->orderBy('created_at','desc');
    }

    public function serviceresult() {
        return $this->hasOne('App\Models\Serviceresult')->orderBy('created_at','desc');
    }

    public function alat() {
        return $this->belongsTo('App\Models\Alat');
    }
}
