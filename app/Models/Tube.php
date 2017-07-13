<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{
    protected $fillable = ['no_tabung', 'customer_id', 'gas_diisikan', 'kode_tabung', 'warna_tabung', 'isi_tabung', 'tanggal_pembuatan', 'status', 'barcode', 'terakhir_hydrostatic','terakhir_visualstatic', 'terakhir_service'];
    protected $dates = array('terakhir_hydrostatic','terakhir_visualstatic', 'terakhir_service');

    public function customer() {
    	return $this->belongsTo('App\Models\Customer');
    }

    public function itemujiriksa() {
        return $this->hasMany('App\Models\Itemujiriksa');
    }

}
