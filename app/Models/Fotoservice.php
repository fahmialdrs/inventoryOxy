<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotoservice extends Model
{

    public $timestamps = false;
    
    public function serviceresult() {
    	return $this->belongsTo('App\Models\Serviceresult');
    }
}
