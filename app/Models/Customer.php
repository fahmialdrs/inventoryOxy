<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function tube() {
    	return $this->hasMany('App\Models\Tube');
    }

    public function formujiriksa() {
    	return $this->hasMany('App\Models\Formujiriksa');
    }

    public function billing() {
    	return $this->hasMany('App\Models\Billing');
    }

    public function alat() {
        return $this->hasMany('App\Models\Alat');
    }
}
