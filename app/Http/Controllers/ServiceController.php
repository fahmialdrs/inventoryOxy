<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Serviceresult;
use App\Models\Fotoservice;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Formujiriksa::with('tube')->get();
        return view('service.index')->with(compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $form = Formujiriksa::where('id', $id)->get()->first();
        return view('service.create')->with(compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        // request semua data
        $data = $request->except(['customer_id','foto_tabung_visual', 'keterangan_foto']);

                
        // penentuan nomer registrasi berdasarkan jenis uji
        $nouji = "SVC-". Carbon::now();
        
        $data['no_registrasi'] = $nouji;
        $data['progress'] = 'Waiting List';
        $data['user_id'] = Auth::user()->id;

        $services = Formservice::create($data);

        
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
            $services->fototabung()->sync([$fototabung->id]);
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Registrasi Service dengan no Registrasi <b> $nouji </b> Berhasil"
            ]);

        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $services = Serviceresult::with(['itemujiriksa'])->find($id);
        $form = Fotoservice::where('serviceresult_id', $id)->get();
        return view('service.show', array(
            'services' => $services,
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
        $services = Formservice::with('tube', 'fototabung')->findOrFail($id);
        return view('service.edit')->with(compact('services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $services = Formujiriksa::findOrFail($id);
        if (!$services->update($request->except(['customer_id','foto_tabung_visual', 'keterangan_foto']))) return redirect()->back();

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

            if($services->foto_tabung_masuk) {
                $old_foto = $services->foto_tabung_masuk;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $services->foto_tabung_masuk;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah tidak ada
                }
            }

            // mengisi field cover di book dengan filename yg baru dibuat
            $services->foto_tabung_masuk = $filename;
            $services->save();
        }
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Perubahan Form Registrasi Ujiriksa Dengan Nomer Registrasi <b> $services->no_registrasi </b> Berhasil"
        ]);

            return redirect()->route('service.index');
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

    public function createHasil()
    {
        return view('service.createHasil');
    }

    public function storeHasil(Request $request)
    {

        $this->validate($request, [
            'foto_tabung_service' => 'image|max:8192',
            'keterangan_service' => 'required|max:255',
            'formservice_id'=>'required|exists:formservices,id',
        ]);

        // isi field cover jika ada cover yg di upload

        if ($request->hasFile('foto_tabung_service')) {
            
            //ambil file yang di upload
            $uploaded = $request->file('foto_tabung_service');

            // ambil extension file
            $extension = $uploaded->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded->move($destinationPath, $filename);

            // mengisi field cover di book dengan filename yg baru dibuat

            $services = new Serviceresult();
            $services->foto_tabung_service = $filename;
            $services->keterangan_service = $request->input('keterangan_service');
            $services->save();
            // $services = Visualresult::create([
            //     'foto_tabung_visual'=>$filename,
            //     'keterangan_foto'=> $request->input('keterangan_foto')
            // ]);
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Input Hasil Service Dengan No Registrasi <b>  </b> Berhasil"
            ]);

        return redirect()->route('service.index');
    }

    public function showHasil($id)
    {
        return view('service.show');
    }

    public function editHasil($id)
    {
        $services = Serviceresult::with('formservice')->findOrFail($id);
        return view('service.editHasil')->with(compact('services'));
    }

    public function updateHasil(Request $request, $id)
    {
        $this->validate($request, [
            'foto_tabung_service' => 'image|max:8192',
            'keterangan_service' => 'required|max:255',
            'formservice_id'=>'required|exists:formservice,id',
        ]);

        $services = Serviceresult::findOrFail($id);
        if (!$services->update($request->all())) return redirect()->back();

        // isi field cover jika ada cover yg di upload

        if ($request->hasFile('foto_tabung_service')) {
            
            //ambil file yang di upload
            $uploaded = $request->file('foto_tabung_service');

            // ambil extension file
            $extension = $uploaded->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded->move($destinationPath, $filename);

            //hapus cover lama jika ada

            if($services->foto_tabung_service) {
                $old_foto = $services->foto_tabung_service;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                . DIRECTORY_SEPARATOR . $visual->foto_tabung_service;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah tidak ada
                }
            }

            // mengisi field cover di book dengan filename yg baru dibuat
            $services->foto_tabung_service = $filename;
            $services->save();
        }
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Perubahan Hasil Service Dengan Nomer Registrasi $services->no_registrasi Berhasil"
        ]);

            return redirect()->route('service.index');
    }

    public function destroyHasil($id)
    {
        // 
    }
}
