<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Tube;
use App\Models\Alat;
use App\Models\Jenisalat;
use App\Models\Merk;
use App\Models\Tipe;

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
        	'no_tabung'=>'tbg01fhm',
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
        	'no_tabung'=>'tbg02fhm',
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
        	'no_tabung'=>'tbg03ifn',
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

        $tabung3 = Tube::create([
            'no_tabung'=>'tbg04ifn',
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

        $jenisalat1= Jenisalat::create([
            'nama_alat' => 'Booties',            
            'reminder' => 1,
            'keterangan' => 'Booties'
            ]);

        $jenisalat2= Jenisalat::create([
            'nama_alat' => 'BCD',
            'reminder' => 0,
            'keterangan' => 'BCD'
            ]);

        $merk1 = Merk::create([
            'nama_merk' => 'Aeroskin',
            'keterangan' => 'Aeroskin'
            ]);

        $merk2 = Merk::create([
            'nama_merk' => 'Amscud',
            'keterangan' => 'Amscud'
            ]);

        $tipe1 = Tipe::create([
            'nama_tipe' => 't one',
            'keterangan' => 't one'
            ]);

        $tipe2 = Tipe::create([
            'nama_tipe' => 'm-25',
            'keterangan' => 'm-25'
            ]);

        $alat1 = Alat::create([
            'no_alat' => '002',
            'ukuran' => 'XXS',
            'warna' => 'Hitam',
            'catatan' => 'Clean',
            'terakhir_service' => '2017-01-01',
            'jenisalat_id' => $jenisalat1->id,
            'merk_id' => $merk1->id,
            'tipe_id' => $tipe1->id,
            'customer_id' => $customer1->id
            ]);

        $alat2 = Alat::create([
            'no_alat' => '003',
            'ukuran' => 'XXS',
            'warna' => 'Hitam',
            'catatan' => 'Clean',
            'terakhir_service' => '2017-01-01',
            'jenisalat_id' => $jenisalat1->id,
            'merk_id' => $merk2->id,
            'tipe_id' => $tipe1->id,
            'customer_id' => $customer1->id
            ]);

        $alat3 = Alat::create([
            'no_alat' => '004',
            'ukuran' => 'XXS',
            'warna' => 'Hitam',
            'catatan' => 'Clean',
            'terakhir_service' => '2017-01-01',
            'jenisalat_id' => $jenisalat2->id,
            'merk_id' => $merk1->id,
            'tipe_id' => $tipe2->id,
            'customer_id' => $customer2->id
            ]);

        $alat4 = Alat::create([
            'no_alat' => '001',
            'ukuran' => 'XXS',
            'warna' => 'Hitam',
            'catatan' => 'Clean',
            'terakhir_service' => '2017-01-01',
            'jenisalat_id' => $jenisalat2->id,
            'merk_id' => $merk2->id,
            'tipe_id' => $tipe2->id,
            'customer_id' => $customer2->id
            ]);
    }
}
