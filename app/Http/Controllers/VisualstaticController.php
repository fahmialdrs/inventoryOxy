<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Visualresult;
use App\Models\Formujiriksa;
use App\Models\Fotovisual;
use Illuminate\Support\Facades\Session;

class VisualstaticController extends Controller
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
        return view('visualstatic.create')->with(compact('form'));
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
            'foto_tabung_visual' => 'image|max:8192',
            'keterangan_foto' => 'required|max:255',
            'formujiriksa_id'=>'required|exists:formujiriksas,id',
        ]);

        // isi field cover jika ada cover yg di upload

        if ($request->hasFile('foto_tabung_visual')) {
            
            //ambil file yang di upload
            $uploaded = $request->file('foto_tabung_visual');

            // ambil extension file
            $extension = $uploaded->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded->move($destinationPath, $filename);

            // mengisi field cover di book dengan filename yg baru dibuat

            $visual = new Visualresult();
            $visual->foto_tabung_visual = $filename;
            $visual->keterangan_foto = $request->input('keterangan_foto');
            $visual->save();
            // $visual = Visualresult::create([
            //     'foto_tabung_visual'=>$filename,
            //     'keterangan_foto'=> $request->input('keterangan_foto')
            // ]);
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Input Hasil Uji Visualstatic Dengan No Registrasi <b>  </b> Berhasil"
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
        $visuals = Visualresult::with(['itemujiriksa'])->find($id);
        $form = Fotovisual::where('visualresult_id', $id)->get();
        return view('visualstatic.show', array(
            'visuals' => $visuals,
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
        $visual = Visualresult::with('formujiriksa')->findOrFail($id);
        return view('visualstatic.edit')->with(compact('visual'));
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
        $this->validate($request, [
            'foto_tabung_visual' => 'image|max:8192',
            'keterangan_foto' => 'required|max:255',
            'formujiriksa_id'=>'required|exists:formujiriksas,id',
        ]);

        $visual = Visualresult::findOrFail($id);
        if (!$visual->update($request->all())) return redirect()->back();

        // isi field cover jika ada cover yg di upload

        if ($request->hasFile('foto_tabung_visual')) {
            
            //ambil file yang di upload
            $uploaded = $request->file('foto_tabung_visual');

            // ambil extension file
            $extension = $uploaded->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded->move($destinationPath, $filename);

            //hapus cover lama jika ada

            if($visual->foto_tabung_masuk) {
                $old_foto = $visual->foto_tabung_visual;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $visual->foto_tabung_visual;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah tidak ada
                }
            }

            // mengisi field cover di book dengan filename yg baru dibuat
            $visual->foto_tabung_visual = $filename;
            $visual->save();
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
