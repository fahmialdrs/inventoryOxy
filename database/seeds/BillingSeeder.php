<?php

use Illuminate\Database\Seeder;
use App\Models\Billing;
use App\Models\ItemBilling;
use database\seeds\TabungsSeeder;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bill1 = Billing::create([
        	'customer_id'=>1,
        	'no_invoice'=>'INV01',
        	'tanggal_invoice'=>'2017-03-30',
            'perihal'=>'service valve',
        	'subtotal'=>1100000,
        	'ongkir'=>10000,
        	'discount'=>10,
        	'total'=>1000000,
        	'terbilang'=>'Satu Juta',
        	'status'=>'Sudah Bayar'
        	]);

        $item1 = Itembilling::create([
        	'billing_id'=>$bill1->id,
        	'quantity'=>2,
        	'deskripsi'=>'Service Valve',
        	'unitprice'=>550000,
        	'amount'=>1100000
        	]);
    }
}
