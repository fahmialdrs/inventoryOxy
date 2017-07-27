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
use Illuminate\Support\Facades\Mail;


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
        $form = Formujiriksa::where('id', $id)->with('customer','itemujiriksa.tube')->get()->first();
        // dd($form);
        return view('hydrostatic.create')->with(compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->except(['customer_id', 'tanggal_uji', 'tube_id','gas_diisikan', 'kode_tabung', 'warna_tabung', 'isi_tabung']);
        $noform = $request->no_registrasi;
        // dd($request->all());
        $data = $request->hydrostaticresult;
        if(isset($data)){
            foreach ($data as $h ) {
                $hydro = new Hydrostaticresult([
                    'tekanan_kerja' => $h['tekanan_kerja'],
                    'tekanan_pemadatan' => $h['tekanan_pemadatan'],
                    'pabrik_pembuat_tabung' => $h['pabrik_pembuat_tabung'],
                    'pabrik_pemakai_tabung' => $h['pabrik_pemakai_tabung'],
                    'berat_tercatat' => $h['berat_tercatat'],
                    'berat_sekarang' => $h['berat_sekarang'],
                    'selisih_min' => $h['selisih_min'],
                    'selisih_plus' => $h['selisih_plus'],
                    'selisih_pers' => $h['selisih_pers'],
                    'air_dipadatkan' => $h['air_dipadatkan'],
                    'pemuaian_tetap_cm3' =>$h['pemuaian_tetap_cm3'],
                    'pemuaian_tetap_pers' => $h['pemuaian_tetap_pers'],
                    'suara_pukulan' => $h['suara_pukulan'],
                    'keadaan_karat' => $h['keadaan_karat'],
                    'keadaan_luar' => $h['keadaan_luar'],
                    'masa_berpori' => $h['masa_berpori'],
                    'keterangan' => $h['keterangan'],
                    'itemujiriksa_id' => $h['itemujiriksa_id']
                    ]);
                $hydro['tanggal_uji'] = $request->tanggal_uji;

                // dd($hydro);
                $hydro->save();
            }
        }

        $hydros = $hydro->with('itemujiriksa.formujiriksa.customer')->orderBy('created_at', 'desc')->first();

        Mail::send('hydrostatic.email', compact('hydros'), function ($m) use ($hydros) {
            $m->to($hydros->itemujiriksa->formujiriksa->customer->email, $hydros->itemujiriksa->formujiriksa->customer->nama)->subject('NDT Dive Laporan Pengerjaan');
        });

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Input Hasil Hydrostatic Pada Form Ujiriksa <b>$noform</b> Berhasil"
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
        $hydro = Hydrostaticresult::with(['itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('hydrostatic.show', array(
            'hydro' => $hydro,
            'form' => $form
            ));
    }
    public function showAll($id)
    {
        // $hydro = Formujiriksa::with(['itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        $form = Formujiriksa::with('customer')->find($id);
        $hydro = Itemujiriksa::where('formujiriksa_id', $id)->with('formujiriksa.customer','tube.customer', 'hydrostaticresult')->get();
        return view('hydrostatic.showAll', array(
            'hydro' => $hydro,
            'form' => $form
            ));
    }

    public function edit($id)
    {
        $hydro = Hydrostaticresult::with('itemujiriksa.formujiriksa','itemujiriksa.tube.customer')->findOrFail($id);
        return view('hydrostatic.edit')->with(compact('hydro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function editSingle($id)
    // {
    //     $hydro = Hydrostaticresult::with('itemujiriksa.formujiriksa','itemujiriksa.tube.customer')->findOrFail($id);
    //     return view('hydrostatic.editSingle')->with(compact('hydro'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $hydro = Hydrostaticresult::with('itemujiriksa.formujiriksa')->findOrFail($id);
        if (!$hydro->update($request->all())) return redirect()->back();

        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Update Hasil Hydrostatic Pada Form Ujiriksa <b>" . $hydro->itemujiriksa->formujiriksa->no_registrasi . "</b> Berhasil"
        ]);

        return redirect()->route('hydrostatic.showAll',$hydro->itemujiriksa->formujiriksa->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hydro = Hydrostaticresult::with('itemujiriksa.tube')->find($id);
        $hydro->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" Hasil Hydrostatic Dengan Nomer Tabung <b> " . $hydro->itemujiriksa->tube->no_tabung . "</b> Berhasil Dihapus!"
            ]);
        return redirect()->back();
    }

    public function import()
    {
        return view('hydrostatic.import');
    }

    public function generateExcelTemplate($id) {

        $hydros = Itemujiriksa::where('formujiriksa_id', $id)->with('formujiriksa.customer','tube.customer', 'hydrostaticresult')->get();
        Excel::create('Template Import Hasil Hydrostatic', function($excel) use ($hydros) {
            // set properties
            $excel->setTitle('Template Import Hasil Hydrostatic')
            ->setCreator('NDT Dive')
            ->setCompany('NDT Dive')
            ->setDescription('Import Template Hydrostatic');

            $excel->sheet('Data Hasil Hydrostatic', function($sheet) use ($hydros) {
                $row = 1;
                $sheet->row($row, [
                    'gas_diisikan',
                    'tanggal_uji',
                    'no_tabung',
                    'kode_tabung',
                    'warna_tabung',
                    'tekanan_kerja',
                    'tekanan_pemadatan',
                    'pabrik_pembuat_tabung',
                    'pabrik_pemakai_tabung',
                    'berat_tercatat',
                    'berat_sekarang',
                    'selisih_min',
                    'selisih_plus',
                    'selisih_pers',
                    'isi_tabung',
                    'air_dipadatkan',
                    'pemuaian_tetap_cm3',
                    'pemuaian_tetap_pers',
                    'suara_pukulan',
                    'keadaan_karat',
                    'keadaan_luar',
                    'masa_berpori',
                    'keterangan',
                    'itemujiriksa_id'
                    ]);

                foreach ($hydros as $h) {
                    $sheet->row(++$row, [
                    $h->tube->gas_diisikan,
                    '',
                    $h->tube->no_tabung,
                    $h->tube->kode_tabung,
                    $h->tube->warna_tabung,
                    $h->tube->isi_tabung,
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    $h->id
                ]);                    
            }
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
        'gas_diisikan',
        'tanggal_uji' => 'required',
        'no_tabung' => 'required',
        'kode_tabung' => 'required',
        'warna_tabung' => 'required',
        'tekanan_kerja' => 'required',
        'tekanan_pemadatan' => 'required',
        'pabrik_pembuat_tabung' => 'required',
        'pabrik_pemakai_tabung' => 'required',
        'berat_tercatat' => 'required',
        'berat_sekarang' => 'required',
        'selisih_min' => 'required',
        'selisih_plus' => 'required',
        'selisih_pers' => 'required',
        'isi_tabung' => 'required',
        'air_dipadatkan' => 'required',
        'Pemuaian_Tetap_Cm3' => 'required',
        'pemuaian_tetap_pers' => 'required',
        'suara_pukulan' => 'required',
        'keadaan_karat' => 'required',
        'keadaan_luar' => 'required',
        'masa_berpori' => 'required',
        'keterangan' => 'required',
        'itemujiriksa_id' => 'required'
        ];

        // catat semua id form
        // ID ini kita butuhkan untuk menghitung total form hydro yang berhasil diimport

        $formhydrostatic_id =[];

        // looping setiap baris dari baris ke 2. karena baris ke 1 adalah header
        
        foreach ($excels as $row) {
            // membuat validasi untuk row di excel
            // kita buah baris yang sedang diproses menjadi array
            // dd($row);
            $validator =  Validator::make($row->toArray(), $rowRules);

            // skip baris ini jika tidak valid, langsung ke baris selanjutnya

            // if($validator->fails()) continue;

            // syntax dibawah di eksekusi ketika baris valid

            // cek apakah Tabung sudah terdaftar
            $form = Itemujiriksa::where('id', $row['itemujiriksa_id'])->first();


            // buat penulis jika belum ada
            // if(!$form) {
            //     continue;
            // }

            // buat Hasil Hydrostatic
            $hasil = Hydrostaticresult::create([
                'tekanan_kerja' => $row['tekanan_kerja'],
                'tekanan_pemadatan' => $row['tekanan_pemadatan'],
                'pabrik_pembuat_tabung' => $row['pabrik_pembuat_tabung'],
                'pabrik_pemakai_tabung' => $row['pabrik_pemakai_tabung'],
                'berat_tercatat' => $row['berat_tercatat'],
                'berat_sekarang' => $row['berat_sekarang'],
                'selisih_min' => $row['selisih_min'],
                'selisih_plus' => $row['selisih_plus'],
                'selisih_pers' => $row['selisih_pers'],
                'air_dipadatkan' => $row['air_dipadatkan'],
                'pemuaian_tetap_cm3' => $row['pemuaian_tetap_cm3'],
                'pemuaian_tetap_pers' => $row['pemuaian_tetap_pers'],
                'suara_pukulan' => $row['suara_pukulan'],
                'keadaan_karat' => $row['keadaan_karat'],
                'keadaan_luar' => $row['keadaan_luar'],
                'masa_berpori' => $row['masa_berpori'],
                'tanggal_uji' => $row['tanggal_uji']->format('Y-m-d'),
                'keterangan' => $row['keterangan'],
                'itemujiriksa_id' => $row['itemujiriksa_id']
                ]);

            // catat id buku yang baru dibuat
            array_push($formhydrostatic_id, $form->id);
        }
        // ambil semua buku yang baru dibuat
        $hasils = Itemujiriksa::whereIn('id', $formhydrostatic_id)->with(['formujiriksa','tube', 'hydrostaticresult'])->get();
        // dd($hasils);
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
