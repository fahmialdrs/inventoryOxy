<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Fototabung;
use App\Models\Tube;
use App\Models\Hydrostaticresult;
use App\Models\Visualresult;
use App\Models\Serviceresult;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;


class UjiriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formujiriksas = Formujiriksa::with('itemujiriksa')->orderBy('created_at', 'desc')->get();
        return view('ujiriksa.index')->with(compact('formujiriksas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabungs = Tube::all();
        return view('ujiriksa.create')->with(compact('tabungs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'tube_id' => 'required|exists:tubes,id',
        //     'keluhan' => 'required|max:255',
        //     'jenis_uji' => 'required|max:255',
        //     'foto_tabung_masuk'=> 'image|max:8192',
        // ]);

        // request semua data
        $data = $request->except('keterangan_foto');

        // tarik jenis uji
        $jenisuji = $request->input('jenis_uji');

        $date = Carbon::parse('now');
        $kode = $date->format('dm').'-'. '1' . '/UJI/NDT/' . $date->format('Y');
        
        // penentuan nomer registrasi berdasarkan jenis uji
        if ($jenisuji == 'Hydrostatic') {
            $nouji = "HYDR-" . $kode;
        }
        elseif ($jenisuji == 'Visualstatic') {
            $nouji = "VSL-". $kode;
        }
        elseif ($jenisuji == 'Service') {
            $nouji = "SVC-". $kode;
        }
        $data['no_registrasi'] = $nouji;
        $data['jenis_uji'] = $jenisuji;
        $data['progress'] = 'Waiting List';
        $data['user_id'] = Auth::user()->id;
        array_forget($data,'itemujiriksa');
        array_forget($data,'foto_tabung_masuk');
        // dd($data);
        $table = new Formujiriksa;
        $table->fill($data);
        $table->save();

        if (isset($request->itemujiriksa)) {
            foreach ($request->itemujiriksa as $key ) {
                    $item = new Itemujiriksa([
                        'jumlah_barang' => $key['jumlah_barang'],
                        'nama_barang' => $key['nama_barang'],
                        'tube_id' => $key['tube_id'],
                        'keluhan' => $key['keluhan']
                    ]);
                    $table->itemujiriksa()->save($item);
                    
                    // isi field cover jika ada cover yg di upload
                if ($request->hasFile('foto_tabung_masuk')) {
                    
                    //ambil file yang di upload
                    $uploaded = $request->file('foto_tabung_masuk');

                    // ambil extension file
                    $extension = $uploaded->getClientOriginalExtension();

                    // membuat nama file random
                    $filename = md5(time()) . '.' . $extension;

                    // simpan file ke folder storage/foto

                    $destinationPath = storage_path() . DIRECTORY_SEPARATOR . 'foto';
                    $uploaded->move($destinationPath, $filename);

                    // mengisi field foto tabung masuk dengan filename yg baru dibuat
                    
                    $foto = new Fototabung([
                        'foto_tabung_masuk' => $filename,
                        'itemujiriksa_id' => $item->id
                        ]);
                    // dd($foto);

                    $foto->save();

                    // save ke table fototabungs
                    // $item->fototabung()->save($fototabungs); 
                }
            }
        }
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Registrasi Ujiriksa dengan no Registrasi <b> $nouji </b> Berhasil"
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
        $form = Formujiriksa::with('itemujiriksa.tube','itemujiriksa.hydrostaticresult', 'itemujiriksa.visualresult', 'itemujiriksa.serviceresult')->find($id);
        $itemujiriksa = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('ujiriksa.show', array(
            'form' => $form,
            'itemujiriksa' => $itemujiriksa
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
        $ujiriksas = Formujiriksa::with('tube', 'fototabung')->findOrFail($id);
        return view('ujiriksa.edit')->with(compact('ujiriksas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'tube_id' => 'required|exists:tubes,id',
        //     'keluhan' => 'required|max:255',
        //     'jenis_uji' => 'required|max:255',
        //     'foto_tabung_masuk'=> 'image|max:8192',
        // ]);

        $ujiriksas = Formujiriksa::findOrFail($id);
        if (!$ujiriksas->update($request->all())) return redirect()->back();

        // isi field cover jika ada cover yg di upload

        if ($request->hasFile('foto_tabung_masuk')) {
            
            //ambil file yang di upload
            $uploaded = $request->file('foto_tabung_masuk');

            // ambil extension file
            $extension = $uploaded->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded->move($destinationPath, $filename);

            //hapus cover lama jika ada

            if($ujiriksas->foto_tabung_masuk) {
                $old_foto = $ujiriksas->foto_tabung_masuk;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $ujiriksas->foto_tabung_masuk;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah tidak ada
                }
            }

            // mengisi field cover di book dengan filename yg baru dibuat
            $ujiriksas->foto_tabung_masuk = $filename;
            $ujiriksas->save();
        }
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Perubahan Form Registrasi Ujiriksa Dengan Nomer Registrasi $ujiriksas->no_registrasi Berhasil"
        ]);

            return redirect()->route('ujiriksa.index');
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

    public function changeStatus($id)
    {
        $ujiriksas = Formujiriksa::with('customer', 'itemujiriksa.tube')->find($id);
        $status = $ujiriksas->progress;
        if($status == "Waiting List") {
            $ujiriksas->progress = "Sedang Dikerjakan";
            $ujiriksas->progress_at = Carbon::today();
            $ujiriksas->save();
            Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Status Formujiriksa <b> $ujiriksas->no_registrasi </b> Sudah Diperbaharui"
            ]);    
        }
        elseif($status == "Sedang Dikerjakan"){
            $ujiriksas->progress = "Selesai";
            $ujiriksas->done_at = Carbon::today();

            Mail::send('ujiriksa.email', compact('ujiriksas'), function ($m) use ($ujiriksas) {
                $m->to($ujiriksas->customer->email, $ujiriksas->customer->nama)->subject('NDT Dive Laporan Pengerjaan');
            });
            $ujiriksas->save();
            Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Status Formujiriksa <b> $ujiriksas->no_registrasi </b> Sudah Diperbaharui dan Email Telah Terkirim ke <b>". $ujiriksas->customer->email . "</b>"
            ]); 
        }

        return redirect()->route('ujiriksa.index');
    }

    public function storePengambil(Request $request, $id)
    {
        $ujiriksas = Formujiriksa::find($id);
        $pengambil = $request->only('nama_pengambil');
        $ujiriksas->nama_pengambil = $pengambil;
        
        $ujiriksas->save();

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Item formujiriksa <b> $ujiriksas->no_registrasi </b> Sudah Diambil oleh <b>$pengambil</b>"
            ]);

        return redirect()->route('ujiriksa.index');
    }

    public function exportPdf($id) {
        $ujiriksas = Formujiriksa::with('customer','itemujiriksa.tube', 'user')->find($id);
        // dd($billings);
        $pdf = PDF::loadView('ujiriksa.pdf', compact('ujiriksas'));
        $filename = 'Form Ujiriksa-'.' '.$ujiriksas->no_registrasi.'.pdf';
        return $pdf->stream($filename);
    }
}
