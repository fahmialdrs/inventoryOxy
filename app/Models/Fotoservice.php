<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotoservice extends Model
{

	protected $guarded = [];
    public $timestamps = false;
    
    public function serviceresult() {
    	return $this->belongsTo('App\Models\Serviceresult');
    }
}
