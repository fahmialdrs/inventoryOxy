<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Session;
use Auth;
use Carbon\Carbon;
use App\Models\Serviceresult;
use App\Models\Fotoservice;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $services = Formujiriksa::with('tube')->get();
        // return view('service.index')->with(compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $form = Formujiriksa::where('id', $id)->with('customer','itemujiriksa.tube','itemujiriksa.alat')->get()->first();
        // dd($form);
        return view('service.create')->with(compact('form'));
    }

    public function createAPI($id)
    {
        $form = Formujiriksa::where('id', $id)->with('customer','itemujiriksa.tube','itemujiriksa.alat')->get()->first();
        // dd($form);
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
        $noform = $request->no_registrasi;
        $data = $request->all();
        // array_forget($data, 'jenisfile');

        if(isset($data)){
            $dataService = $request->serviceresult;
            foreach ($dataService as $v ) {
                $service = new Serviceresult([
                    'keterangan_service' => $v['keterangan_service'],
                    'itemujiriksa_id' => $v['itemujiriksa_id']
                    ]);
                // dd($service->load('itemujiriksa'));
                $service->save();

                if (is_array($v['foto_tabung_service'])) {
                    $uploaded = $v['foto_tabung_service'];

                    foreach ($uploaded as $foto) {
                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        if($foto->getClientMimeType() == 'video/mp4') {
                            
                            $destinationPath = storage_path('app/public/foto');
                            $foto->move($destinationPath, $filename);

                            // mengisi field foto tabung masuk dengan filename yg baru dibuat
                            
                            Fotoservice::create([
                                'video_tabung_service' => $filename,
                                'serviceresult_id' => $service->id
                                ]);
                        }
                        else {
                            $destinationPath = storage_path('app/public/foto');
                            $foto->move($destinationPath, $filename);

                            // mengisi field foto tabung masuk dengan filename yg baru dibuat
                            
                            Fotoservice::create([
                                'foto_tabung_service' => $filename,
                                'serviceresult_id' => $service->id
                            ]);
                        }                      
                    }
                }
            }
        }

        $services = $service->with('itemujiriksa.formujiriksa.customer')->orderBy('created_at', 'desc')->first();

        Mail::send('service.email', compact('services'), function ($m) use ($services) {
            $m->to($services->itemujiriksa->formujiriksa->customer->email, $services->itemujiriksa->formujiriksa->customer->nama)->subject('NDT Dive Laporan Pengerjaan');
        });

        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Registrasi Service dengan no Registrasi <b> $noform </b> Berhasil"
            ]);

        return redirect()->route('ujiriksa.index');
    }

    public function storeAPI(Request $request)
    {
        $noform = $request->no_registrasi;
        $data = $request->all();
        // array_forget($data, 'jenisfile');

        if(isset($data)){
            $dataService = $request->serviceresult;
            foreach ($dataService as $v ) {
                $service = new Serviceresult([
                    'keterangan_service' => $v['keterangan_service'],
                    'itemujiriksa_id' => $v['itemujiriksa_id']
                    ]);
                // dd($service->load('itemujiriksa'));
                $service->save();

                if (is_array($v['foto_tabung_service'])) {
                    $uploaded = $v['foto_tabung_service'];

                    foreach ($uploaded as $foto) {
                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        if($foto->getClientMimeType() == 'video/mp4') {
                            
                            $destinationPath = storage_path('app/public/foto');
                            $foto->move($destinationPath, $filename);

                            // mengisi field foto tabung masuk dengan filename yg baru dibuat
                            
                            Fotoservice::create([
                                'video_tabung_service' => $filename,
                                'serviceresult_id' => $service->id
                                ]);
                        }
                        else {
                            $destinationPath = storage_path('app/public/foto');
                            $foto->move($destinationPath, $filename);

                            // mengisi field foto tabung masuk dengan filename yg baru dibuat
                            
                            Fotoservice::create([
                                'foto_tabung_service' => $filename,
                                'serviceresult_id' => $service->id
                                ]);
                            }

                        
                    }
                }
            }
        }

        $services = $service->with('itemujiriksa.formujiriksa.customer')->orderBy('created_at', 'desc')->first();

        Mail::send('service.email', compact('services'), function ($m) use ($services) {
            $m->to($services->itemujiriksa->formujiriksa->customer->email, $services->itemujiriksa->formujiriksa->customer->nama)->subject('NDT Dive Laporan Pengerjaan');
        });

        return response()->json(['error' => false, 'message' => 'Hasil Service Berhasil diinput']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Serviceresult::with(['fotoservice','itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer', 'itemujiriksa.alat.customer'])->find($id);
        // $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('service.show', array(
            'service' => $service
            ));
    }

    public function showAll($id)
    {
        $form = Formujiriksa::with('customer')->find($id);
        $service = Itemujiriksa::where('formujiriksa_id', $id)->with('formujiriksa.customer','tube.customer', 'alat.customer', 'serviceresult.fotoservice')->get();

        return view('service.showAll', array(
            'service' => $service,
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
        $service = Serviceresult::with('fotoservice','itemujiriksa.formujiriksa','itemujiriksa.tube.customer', 'itemujiriksa.alat.customer')->findOrFail($id);
        return view('service.edit')->with(compact('service'));
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
        $service = Serviceresult::with('itemujiriksa.formujiriksa')->findOrFail($id);
        $data = $request->all();
        array_forget($data,'foto_tabung_service');
        array_forget($data,'jenisfile');
        
        if (!$service->update($data)) return redirect()->back();

        // isi field cover jika ada cover yg di upload
        if ($request->hasFile('foto_tabung_service')) {
            foreach ($service->fotoservice as $ft) {
             
                $filepath = storage_path('app/public/foto/') . $ft->foto_tabung_service;

                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // file sudah tidak ada
                    }

                    $ft->delete();
            }

            foreach ($request->foto_tabung_service as $foto) {

                //ambil file yang di upload
                // $uploaded = $request->file('foto_tabung_service');

                // ambil extension file
                $extension = $foto->getClientOriginalExtension();

                // membuat nama file random
                $filename = md5(str_random(8)) . '.' . $extension;

                // simpan file ke folder public/img

                if($foto->getClientMimeType() == 'video/mp4') {
                            
                    $destinationPath = storage_path('app/public/foto');
                    $foto->move($destinationPath, $filename);

                    // mengisi field foto tabung masuk dengan filename yg baru dibuat
                    
                    Fotoservice::create([
                        'video_tabung_service' => $filename,
                        'serviceresult_id' => $service->id
                        ]);
                }
                else {
                    $destinationPath = storage_path('app/public/foto');
                    $foto->move($destinationPath, $filename);

                    // mengisi field foto tabung masuk dengan filename yg baru dibuat
                    
                    Fotoservice::create([
                        'foto_tabung_service' => $filename,
                        'serviceresult_id' => $service->id
                        ]);
                    }
            }
        }
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Update Hasil Service Pada Form Ujiriksa <b>" . $service->itemujiriksa->formujiriksa->no_registrasi . "</b> Berhasil"
        ]);

            return redirect()->route('service.showAll',$service->itemujiriksa->formujiriksa->id);
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
