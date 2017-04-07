<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Tabung;

class TabungsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //sample customer

        $customer1 = Customer::create([
        	'nama'=>'Fahmi Alaydrus',
        	'no_telp'=>'+6281219252331', 
        	'alamat'=>'Kalibata Timur', 
        	'email'=>'fahmialdrs@gmail.com', 
        	'tgl_member'=>'1995-07-12'
        	]);

        $customer2 = Customer::create([
        	'nama'=>'Irfan Alaydrus',
        	'no_telp'=>'+628161881292', 
        	'alamat'=>'Condet', 
        	'email'=>'irfanaldrs@gmail.com', 
        	'tgl_member'=>'1994-04-21'
        	]);

        //sample tabung

        $tabung1 = Tabung::create([
        	'no_tabung'=>'9876543210',
        	'isi_gas'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Silver',
        	'kapasitas_isiTabung'=>'47',
        	'tgl_pembuatan'=>'2017-03-30',
        	'status'=>'Good',
        	'customer_id'=>$customer1->id
        	]);

        $tabung2 = Tabung::create([
        	'no_tabung'=>'01234565432',
        	'isi_gas'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Green',
        	'kapasitas_isiTabung'=>'47',
        	'tgl_pembuatan'=>'2016-08-10',
        	'status'=>'Good',
        	'customer_id'=>$customer1->id
        	]);

        $tabung3 = Tabung::create([
        	'no_tabung'=>'123456789',
        	'isi_gas'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Blue',
        	'kapasitas_isiTabung'=>'47',
        	'tgl_pembuatan'=>'2017-01-01',
        	'status'=>'Good',
        	'customer_id'=>$customer2->id
        	]);
    }
}
