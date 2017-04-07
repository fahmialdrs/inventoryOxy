<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'no_telp', 'alamat', 'email', 'tgl_member'];

    public function tabungs() {
    	return $this->hasMany('App\Models\Tabung');
    }
}
