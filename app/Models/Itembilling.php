<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itembilling extends Model
{
    protected $guarded = [];

    public function billing() {
    	return $this->belongsTo('App\Models\Billing');
    }
}
