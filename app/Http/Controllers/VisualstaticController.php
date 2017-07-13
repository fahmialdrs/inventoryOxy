<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Visualresult;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Fotovisual;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;

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
        $form = Formujiriksa::where('id', $id)->with('customer','itemujiriksa.tube')->get()->first();
        return view('visualstatic.create')->with(compact('form'));
    }

    public function createAPI($id)
    {
        $form = Formujiriksa::where('id', $id)->with('customer','itemujiriksa.tube')->get()->first();
        return response()->json($form);
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
        //     'foto_tabung_visual' => 'image|max:8192',
        //     'keterangan_foto' => 'required|max:255',
        //     'formujiriksa_id'=>'required|exists:formujiriksas,id',
        // ]);

        $noform = $request->no_registrasi;
        $data = $request->all();
        // dd($request->all());
        
        if(isset($data)){
            $dataVisual = $request->visualresult;
            foreach ($dataVisual as $v ) {
                $visual = new Visualresult([
                    'keterangan_visual' => $v['keterangan_visual'],
                    'itemujiriksa_id' => $v['itemujiriksa_id']
                    ]);
                                
                $visual->save();

                if (is_array($v['foto_tabung_visual'])) {
                    $uploaded = $v['foto_tabung_visual'];

                    foreach ($uploaded as $foto) {
                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        $destinationPath = storage_path('app/public/foto');
                        $foto->move($destinationPath, $filename);

                        // mengisi field foto tabung masuk dengan filename yg baru dibuat
                        
                        Fotovisual::create([
                            'foto_tabung_visual' => $filename,
                            'visualresult_id' => $visual->id
                            ]);
                    }
                }
            }
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Input Hasil Uji Visualstatic Dengan No Registrasi <b> $noform </b> Berhasil"
            ]);

        return redirect()->route('ujiriksa.index');
        
    }

    public function storeAPI(Request $request)
    {
        // $this->validate($request, [
        //     'foto_tabung_visual' => 'image|max:8192',
        //     'keterangan_foto' => 'required|max:255',
        //     'formujiriksa_id'=>'required|exists:formujiriksas,id',
        // ]);

        $noform = $request->no_registrasi;
        $data = $request->all();
        // dd($request->all());
        
        if(isset($data)){
            $dataVisual = $request->visualresult;
            foreach ($dataVisual as $v ) {
                $visual = new Visualresult([
                    'keterangan_visual' => $v['keterangan_visual'],
                    'itemujiriksa_id' => $v['itemujiriksa_id']
                    ]);
                                
                $visual->save();

                if (is_array($v['foto_tabung_visual'])) {
                    $uploaded = $v['foto_tabung_visual'];

                    foreach ($uploaded as $foto) {
                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        $destinationPath = storage_path('app/public/foto');
                        $foto->move($destinationPath, $filename);

                        // mengisi field foto tabung masuk dengan filename yg baru dibuat
                        
                        Fotovisual::create([
                            'foto_tabung_visual' => $filename,
                            'visualresult_id' => $visual->id
                            ]);
                    }
                }
            }
        }

        return response()->json(['error' => false, 'message' => 'Hasil Uji Visualstatic Tabung Berhasil diinput']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visual = Visualresult::with(['fotovisual','itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        // $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('visualstatic.show', array(
            'visual' => $visual
            ));
    }

    public function showAll($id)
    {
        $form = Formujiriksa::with('customer')->find($id);
        $visual = Itemujiriksa::where('formujiriksa_id', $id)->with(['formujiriksa.customer','tube.customer', 'visualresult.fotovisual'])->get();
        return view('visualstatic.showAll', array(
            'visual' => $visual,
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
        $visual = Visualresult::with('fotovisual','itemujiriksa.formujiriksa','itemujiriksa.tube.customer')->findOrFail($id);
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
        // $this->validate($request, [
        //     'foto_tabung_visual' => 'image|max:8192',
        //     'keterangan_foto' => 'required|max:255',
        //     'formujiriksa_id'=>'required|exists:formujiriksas,id',
        // ]);

        $visual = Visualresult::findOrFail($id);
        $data = $request->all();
        // dd(isset($request->foto_tabung_visual));
        array_forget($data,'foto_tabung_visual');
        // dd($data);
        
        
        if (!$visual->update($data)) return redirect()->back();

        // isi field foto visuak jika ada foto yg di upload

        if ($request->hasFile('foto_tabung_visual')) {
            foreach ($visual->fotovisual as $ft) {
             
                $filepath = storage_path('app/public/foto/') . $ft->foto_tabung_visual;

                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // file sudah tidak ada
                    }

                    $ft->delete();
            }
            
            foreach ($request->foto_tabung_visual as $foto) {

                //ambil file yang di upload
                // $uploaded = $request->file('foto_tabung_visual');

                // ambil extension file
                $extension = $foto->getClientOriginalExtension();

                // membuat nama file random
                $filename = md5(str_random(8)) . '.' . $extension;

                // simpan file ke folder public/img

                $destinationPath = storage_path('app/public/foto');
                $foto->move($destinationPath, $filename);

                // mengisi field foto visuak didatabase dengan filename yg baru dibuat
                Fotovisual::create([
                    'foto_tabung_visual' => $filename,
                    'visualresult_id' => $visual->id
                    ]);
            }
        }
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Update Hasil Service Pada Form Ujiriksa <b>" . $visual->itemujiriksa->formujiriksa->no_registrasi . "</b> Berhasil"
        ]);

            return redirect()->route('visualstatic.showAll',$visual->itemujiriksa->formujiriksa->id);
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
