<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipe extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function alat() {
    	return $this->hasMany('App\Models\Alat');
    }
}
