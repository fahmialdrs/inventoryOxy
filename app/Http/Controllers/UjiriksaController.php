<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Fototabung;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class UjiriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formujiriksas = Formujiriksa::with('itemujiriksa')->get();
        return view('ujiriksa.index')->with(compact('formujiriksas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ujiriksa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tube_id' => 'required|exists:tubes,id',
            'keluhan' => 'required|max:255',
            'jenis_uji' => 'required|max:255',
            'foto_tabung_masuk'=> 'image|max:8192',
        ]);

        // request semua data
        $data = $request->except(['jumlah_barang', 'nama_barang', 'no_tabung', 'keluhan', 'foto_tabung_masuk', 'keterangan_foto']);

        // tarik jenis uji
        $jenisuji = $request->input('jenis_uji');
        
        // penentuan nomer registrasi berdasarkan jenis uji
        if ($jenisuji == 'Hydrostatic') {
            $nouji = "HYDR-" . Carbon::now();
        }
        elseif ($jenisuji == 'Visualstatic') {
            $nouji = "VSL-". Carbon::now();
        }
        elseif ($jenisuji == 'Service') {
            $nouji = "SVC-". Carbon::now();
        }
        $data['no_registrasi'] = $nouji;
        $data['progress'] = 'Waiting List';
        $data['user_id'] = Auth::user()->id;

        $uji = Formujiriksa::create($data);

        
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

            // mengisi field cover di book dengan filename yg baru dibuat
            $fototabung = Fototabung::create([
                'foto_tabung_masuk'=>$filename,
                'keterangan_foto'=> $request->input('keterangan_foto')
            ]);

            // save ke pivot table
            $uji->fototabung()->sync([$fototabung->id]);
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
        $form = Formujiriksa::find($id);
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
}
