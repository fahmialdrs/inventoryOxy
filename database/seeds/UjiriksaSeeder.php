<?php

use Illuminate\Database\Seeder;
use App\Models\Formujiriksa;
use App\Models\Fototabung;
use App\Models\Fotoservice;
use App\Models\Fotovisual;
use App\Models\Visualresult;
use App\Models\Serviceresult;
use App\Models\Hydrostaticresult;
use App\Models\Itemujiriksa;
use App\User;


class UjiriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form1 = Formujiriksa::create([
        	'no_registrasi'=>'VSL01',
        	'progress'=>'On Progress',
        	'jenis_uji'=>'Visualstatic',
        	'progress'=>'Selesai',
        	'nama_pengambil'=>'fahmi',
            'keterangan'=>'mau di Visualstatic',            
            'nama_penyerah'=>'fahmi',
            'perkiraan_selesai'=>'2017-01-01',
            'perkiraan_biaya'=>'1000000',
            'progress_at'=>'2017-01-01',
            'done_at'=>'2017-01-01',
        	'user_id'=>2,
            'customer_id'=>1
        	]);

        $item1= Itemujiriksa::create([
            'jumlah_barang' => '1',
            'nama_barang' => 'tabung',
            'keluhan' => ' Visual',
            'tube_id' => 1, 
            'formujiriksa_id' => $form1->id
            ]);

        $fototabung1 = Fototabung::create([
            'foto_tabung_masuk'=>'IMG0010.jpg',
            'keterangan_foto'=>'Visual 1',
            'itemujiriksa_id'=> $item1->id
            ]);

        $fototabung2 = Fototabung::create([
            'foto_tabung_masuk'=>'IMG0011.jpg',
            'keterangan_foto'=>'Visual 2',
            'itemujiriksa_id'=> $item1->id
            ]);

        $resultvisual1 = Visualresult::create([
        	'itemujiriksa_id'=> $form1->id,
        	'keterangan_visual'=>'karat'
        	]);

        $fotoresultvisual1 = Fotovisual::create([
            'visualresult_id'=> $resultvisual1->id,
            'foto_tabung_visual'=>'IMG001.jpg'
            ]);

        $fotoresultvisual2 = Fotovisual::create([
            'visualresult_id'=> $resultvisual1->id,
            'foto_tabung_visual'=>'IMG002.jpg'
            ]);

        $form2 = Formujiriksa::create([
            'no_registrasi'=>'HYDR01',
            'progress'=>'On Progress',
            'jenis_uji'=>'Hydrostatic',
            'progress'=>'Selesai',
            'nama_pengambil'=>'fahmi',
            'keterangan'=>'mau di Hydrostatic',            
            'nama_penyerah'=>'fahmi',
            'perkiraan_selesai'=>'2017-01-01',
            'perkiraan_biaya'=>'1000000',
            'progress_at'=>'2017-01-01',
            'done_at'=>'2017-01-01',
            'user_id'=>2,
            'customer_id'=>1
            ]);

        $item2= Itemujiriksa::create([
            'jumlah_barang' => '1',
            'nama_barang' => 'tabung',
            'keluhan' => ' Hydrostatic',
            'tube_id' => 2,
            'formujiriksa_id' => $form2->id
            ]);

        $fototabung3 = Fototabung::create([
            'foto_tabung_masuk'=>'IMG0012.jpg',
            'keterangan_foto'=>'Hydro 1',
            'itemujiriksa_id'=> $item2->id
            ]);

        $fototabung4 = Fototabung::create([
            'foto_tabung_masuk'=>'IMG0013.jpg',
            'keterangan_foto'=>'Hydro 2',
            'itemujiriksa_id'=> $item2->id
            ]);

        $resulthydro1 = Hydrostaticresult::create([
            'itemujiriksa_id'=> $form2->id,
            'tekanan_kerja'=>'40',
            'tekanan_pemadatan'=>'47',
            'pabrik_pembuat_tabung'=>'China',
            'pabrik_pemakai_tabung'=>'CNOOC',
            'berat_tercatat'=>'55',
            'berat_sekarang'=>'58',
            'selisih_min'=>'1.32',
            'selisih_plus'=>'0.8',
            'selisih_pers'=>'0.4',
            'air_dipadatkan'=>'40',
            'pemuaian_tetap_cm3'=>'0.8',
            'pemuaian_tetap_pers'=>'1',            
            'suara_pukulan'=>'Pekak',
            'keadaan_karat'=>'Tidak',
            'keadaan_luar'=>'Tidak Berkeringat',
            'masa_berpori'=>'Tidak',
            'keterangan'=>'Baik',
            'tanggal_uji'=>'2017-04-30'
            ]);

        $form3 = Formujiriksa::create([
            'no_registrasi'=>'SVC01',
            'progress'=>'On Progress',
            'jenis_uji'=>'Service',
            'progress'=>'Selesai',
            'nama_pengambil'=>'fahmi',
            'keterangan'=>'mau di service',            
            'nama_penyerah'=>'fahmi',
            'perkiraan_selesai'=>'2017-01-01',
            'perkiraan_biaya'=>'1000000',
            'progress_at'=>'2017-01-01',
            'done_at'=>'2017-01-01',
            'user_id'=>2,
            'customer_id'=>2
            ]);

        $item3= Itemujiriksa::create([
            'jumlah_barang' => '1',
            'nama_barang' => 'tabung',
            'keluhan' => ' Service',
            'tube_id' => 3,
            'formujiriksa_id' => $form3->id
            ]);

        $fototabung5 = Fototabung::create([
        	'foto_tabung_masuk'=>'IMG0014.jpg',
        	'keterangan_foto'=>'Service1',
            'itemujiriksa_id'=> $item3->id
        	]);

        $fototabung6 = Fototabung::create([
        	'foto_tabung_masuk'=>'IMG0015.jpg',
        	'keterangan_foto'=>'Service2',
            'itemujiriksa_id'=> $item3->id
        	]);

        $resultservice1 = Serviceresult::create([
            'itemujiriksa_id'=> $form3->id,
            'keterangan_service'=>'hasil service 1'
            ]);

        $fotoresultservice1 = Fotoservice::create([
            'serviceresult_id'=> $resultservice1->id,
            'foto_tabung_service'=>'IMG0016.jpg'
            ]);

        $fotoresultservice2 = Fotoservice::create([
            'serviceresult_id'=> $resultservice1->id,
            'foto_tabung_service'=>'IMG0017.jpg'
            ]);        
    }
}
