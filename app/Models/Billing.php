<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
	protected $guarded = [];
	
    public function customer() {
    	return $this->belongsTo('App\Models\Customer');
    }

    public function itembilling() {
    	return $this->hasMany('App\Models\Itembilling');
    }
}
