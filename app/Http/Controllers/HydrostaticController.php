<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hydrostaticresult;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Tube;
use App\Http\Requests\StoreHydrostaticRequest;
use App\Http\Requests\UpdateHydrostaticRequest;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Excel;
use Validator;


class HydrostaticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $form = Formujiriksa::where('id', $id)->get()->first();
        return view('hydrostatic.create')->with(compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHydrostaticRequest $request)
    {
        $data = $request->except(['customer_id', 'tube_id','gas_diisikan', 'kode_tabung', 'warna_tabung', 'isi_tabung']);
        $hydro = Hydrostaticresult::create($data);
        $hydro->formujiriksa->done_at = Carbon::now();
        $hydro->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Input Hasil Hydrostatic Berhasil"
        ]);

        return redirect()->route('ujiriksa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hydro = Hydrostaticresult::with(['itemujiriksa'])->find($id);
        $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('hydrostatic.show', array(
            'hydro' => $hydro,
            'form' => $form
            ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hydro = Hydrostaticresult::with('Formujiriksa')->findOrFail($id);
        return view('hydrostatic.edit')->with(compact('hydro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHydrostaticRequest $request, $id)
    {
        $hydro = Hydrostaticresult::findOrFail($id);
        if (!$hydro->update($request->all())) return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import()
    {
        return view('hydrostatic.import');
    }

    public function generateExcelTemplate() { 
        Excel::create('Template Import Hasil Hydrostatic', function($excel) {
            // set properties
            $excel->setTitle('Template Import Hasil Hydrostatic')
            ->setCreator('NDT Dive')
            ->setCompany('NDT Dive')
            ->setDescription('Import Template Hydrostatic');

            $excel->sheet('Data Hasil Hydrostatic', function($sheet){
                $row = 1;
                $sheet->row($row, [
                    'Gas-Yang-Diisikan',
                    'Tanggal-Pemadatan-Terakhir',
                    'No-Seri-Tabung',
                    'Kode',
                    'Warna-Cat',
                    'Tekanan-Kerja',
                    'Tekanan-Pemadatan',
                    'Nama-Pabrik-Pembuat-Tabung',
                    'Nama-Pabrik-Pemakai-Tabung',
                    'Berat-Yang-Tercatat',
                    'Berat-Timbangan-Sekarang',
                    'Selisih-',
                    'Selisih+',
                    'Selisih%',
                    'Isi-Tabung',
                    'Air-yang-dipadatkan',
                    'Pemuaian-Tetap-cm3',
                    'Pemuaian-Tetap-%',
                    'Suara-Pukulan',
                    'Keadaan-Karat',
                    'Keadaan-Luar',
                    'Masa-Berpori',
                    'Keterangan',
                    'No-Registrasi-Uji'
                    ]);
            });
        })->export('xlsx');
    }  

    public function importExcel(Request $request)
    {
        // validasi file yg diapload adalah excel
        $this->validate($request, ['excel' => 'required|mimes:xls,xlsx' ]);

        // ambil file yang baru di upload

        $excel = $request->file('excel');

        // baca sheet pertama

        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader){
            // option jika ada
        })->get();

        // rule untuk validasi setiap row pada file excel

        $rowRules = [
        'Gas-Yang-Diisikan',
        'Tanggal-Pemadatan-Terakhir' => 'required',
        'No-Seri-Tabung' => 'required',
        'Kode' => 'required',
        'Warna-Cat' => 'required',
        'Tekanan-Kerja' => 'required',
        'Tekanan-Pemadatan' => 'required',
        'Nama-Pabrik-Pembuat-Tabung' => 'required',
        'Nama-Pabrik-Pemakai-Tabung' => 'required',
        'Berat-Yang-Tercatat' => 'required',
        'Berat-Timbangan-Sekarang' => 'required',
        'Selisih-' => 'required',
        'Selisih+' => 'required',
        'Selisih%' => 'required',
        'Isi-Tabung' => 'required',
        'Air-yang-dipadatkan' => 'required',
        'Pemuaian-Tetap-cm3' => 'required',
        'Pemuaian-Tetap-%' => 'required',
        'Suara-Pukulan' => 'required',
        'Keadaan-Karat' => 'required',
        'Keadaan-Luar' => 'required',
        'Masa-Berpori' => 'required',
        'Keterangan' => 'required',
        'No-Registrasi-Uji' => 'required'
        ];

        // catat semua id form
        // ID ini kita butuhkan untuk menghitung total form hydro yang berhasil diimport

        $formhydrostatic_id =[];

        // looping setiap baris dari baris ke 2. karena baris ke 1 adalah header

        foreach ($excels as $row) {
            // membuat validasi untuk row di excel
            // kita buah baris yang sedang diproses menjadi array

            $validator =  Validator::make($row->toArray(), $rowRules);

            // skip baris ini jika tidak valid, langsung ke baris selanjutnya

            if($validator->fails()) continue;

            // syntax dibawah di eksekusi ketika baris valid
            // cek apakah Tabung sudah terdaftar
            $form = Formujiriksa::where('no_registrasi', $row['No-Registrasi-Uji'])->first();

            // buat penulis jika belum ada
            if(!$form) {
                Session::flash("flash_notification", [
                "level" => "warning",
                "message" => "Ada Tabung Yang Belum Terdaftar!"
                ]);
            }
            continue;

            // buat Hasil Hydrostatic
            $hasil = Hydrostaticresult::create([
                'tekanan_kerja' => $row['Tekanan-Kerja'],
                'tekanan_pemadatan' => $row['Tekanan-Pemadatan'],
                'pabrik_pembuat_tabung' => $row['Nama-Pabrik-Pembuat-Tabung'],
                'pabrik_pemakai_tabung' => $row['Nama-Pabrik-Pemakai-Tabung'],
                'berat_tercatat' => $row['Berat-Yang-Tercatat'],
                'berat_sekarang' => $row['Berat-Timbangan-Sekarang'],
                'selisih-' => $row['Selisih-'],
                'selisih+' => $row['Selisih+'],
                'selisih%' => $row['Selisih%'],
                'air_dipadatkan' => $row['Air-yang-dipadatkan'],
                'pemuaian_tetap_cm3' => $row['Pemuaian-Tetap-cm3'],
                'pemuaian_tetap_%' => $row['Pemuaian-Tetap-%'],
                'suara_pukulan' => $row['Suara-Pukulan'],
                'keadaan_karat' => $row['Keadaan-Karat'],
                'keadaan_luar' => $row['Keadaan-Luar'],
                'masa_berpori' => $row['Masa-Berpori'],
                'tanggal_uji' => Carbon::now(),
                'formujiriksa_id' => $form->id,
                'keterangan' => $row['Keterangan'],
                ]);
            // catat id buku yang baru dibuat
            array_push($formhydrostatic_id, $form->id);
        }
        // ambil semua buku yang baru dibuat
        $hasils = Formujiriksa::whereIn('id', $formhydrostatic_id)->get();

        // redirect ke form jika tidak ada buku yang berhasil diimport
        if($hasils->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Hasil Hydrostatic Tidak Terinput!"
                ]);
            return redirect()->back();
        }
        // set feedback
        Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Hasil Uji Hydrostatic Berhasil diimport sebanyak " . $hasils->count()
                ]);
        // tampilkan index buku
        return view('hydrostatic.import-review')->with(compact('hasils'));
    }

    
}
