<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formujiriksa extends Model
{
    protected $guarded = ['nama_pengambil'];
    protected $dates = array('progress_at','done_at');
    
    public function itemujiriksa() {
        return $this->hasMany('App\Models\Itemujiriksa');
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
