<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTrait;

class Formujiriksa extends Model
{
    use ModelTrait;

    protected $guarded = ['nama_pengambil'];
    protected $dates = array('progress_at','done_at');
    protected $casts = [
    'is_service_alat' => 'boolean',
    ];
    
    
    public function itemujiriksa() {
        return $this->hasMany('App\Models\Itemujiriksa');
    }

    public function customer() {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function billing() {
        return $this->hasMany('App\Models\Billing');
    }
}
