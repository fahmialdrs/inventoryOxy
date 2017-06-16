<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotovisual extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    public function visualresult() {
    	return $this->belongsTo('App\Models\Visualresult');
    }
}
