<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Tube;

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
        	'tanggal_member'=>'1995-07-12'
        	]);

        $customer2 = Customer::create([
        	'nama'=>'Irfan Alaydrus',
        	'no_telp'=>'+628161881292', 
        	'alamat'=>'Condet', 
        	'email'=>'irfanaldrs@gmail.com', 
        	'tanggal_member'=>'1994-04-21'
        	]);

        //sample tabung

        $tabung1 = Tube::create([
        	'no_tabung'=>'9876543210',
        	'gas_diisikan'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Silver',
        	'isi_tabung'=>'47',
        	'tanggal_pembuatan'=>'2017-03-30',
            'terakhir_hydrostatic'=>'2017-01-01',
            'terakhir_visualstatic'=>'2017-01-01',
            'terakhir_service'=>'2017-01-01',
        	'status'=>'Baik',
        	'customer_id'=>$customer1->id
        	]);

        $tabung2 = Tube::create([
        	'no_tabung'=>'01234565432',
        	'gas_diisikan'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Green',
        	'isi_tabung'=>'47',
        	'tanggal_pembuatan'=>'2016-08-10',
            'terakhir_hydrostatic'=>'2017-01-01',
            'terakhir_visualstatic'=>'2017-01-01',
            'terakhir_service'=>'2017-01-01',
        	'status'=>'Baik',
        	'customer_id'=>$customer1->id
        	]);

        $tabung3 = Tube::create([
        	'no_tabung'=>'123456789',
        	'gas_diisikan'=>'Oxygen',
        	'kode_tabung'=>'O2',
        	'warna_tabung'=>'Blue',
        	'isi_tabung'=>'47',
        	'tanggal_pembuatan'=>'2017-01-01',
            'terakhir_hydrostatic'=>'2017-01-01',
            'terakhir_visualstatic'=>'2017-01-01',
            'terakhir_service'=>'2017-01-01',
        	'status'=>'Baik',
        	'customer_id'=>$customer2->id
        	]);
    }
}
