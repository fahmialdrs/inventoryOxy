<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenisalat extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
    'reminder' => 'boolean',
    ];

    public function alat() {
    	return $this->hasMany('App\Models\Alat');
    }

    public function getReminderAttribute($value)
    {
    if($value =="") return false;
    return true;
    }
}
