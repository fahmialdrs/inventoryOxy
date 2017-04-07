<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabung extends Model
{
    protected $fillable = ['no_tabung', 'isi_gas', 'kode_tabung', 'warna_tabung', 'kapasitas_isiTabung', 'tgl_pembuatan', 'status', 'customer_id'];

    public function customers() {
    	return $this->belongsTo('App\Models\Customer');
    }
}
