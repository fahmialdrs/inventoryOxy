<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Fototabung;
use App\Models\Tube;
use App\Models\Customer;
use App\Models\Alat;
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
use App\Models\Olah;

class UjiriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hydro = Formujiriksa::with('itemujiriksa')->where('jenis_uji', 'Hydrostatic')->orderBy('created_at', 'desc')->get();
        $visual = Formujiriksa::with('itemujiriksa')->where('jenis_uji', 'Visualstatic')->orderBy('created_at', 'desc')->get();
        $service = Formujiriksa::with('itemujiriksa')->where('jenis_uji', 'Service')->orderBy('created_at', 'desc')->get();
        return view('ujiriksa.index', array(
            'hydro' => $hydro,
            'visual' => $visual,
            'service' => $service
            ));
    }

    public function indexAll(Request $request) {

        /**
             * Costum Class buat ngolah request dan query
             * @var Olah
             */
            $table = new Olah(Formujiriksa::with([]));

            /**
             * Pannggil Closure di costum class Olah 
             * buat costum mana aja field yang bisa di search
             */
            $table->search(function($q) use ($request){
                if(isset($request->search) && $request->search != ''){
                    $q->where('no_registrasi', 'ILIKE', '%' . $request->search . '%');

                }
            });

            $table->another(function($q) use ($request){
                $q->orderBy('created_at', 'desc');
            });
            
            /**
             * Ambil hasil query yang udah di olah
             * @var ambil()
             */
            $table = $table->ambil();
            
            return response()->json($table);

        $data = Formujiriksa::with('itemujiriksa')->orderBy('created_at', 'desc')->get();
        if(!$data) {
            return response()->json(['error' => 'Data Form Registrasi Tidak Ada.'], 400);
        }
        else {
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabungs = Tube::all();
        $alats = Alat::all();
        return view('ujiriksa.create', array(
                'tabungs' => $tabungs,
                'alats' => $alats
            ));
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
        // dd($request->all());

        // tarik jenis uji
        $jenisuji = $request->input('jenis_uji');

        $date = Carbon::parse('now');
        $counter = Formujiriksa::whereDate('created_at','=',date('Y-m-d'))->count()+1;
        // dd($counter);
        $kode = $date->format('dm').'-'. $counter . '/UJI/NDT/' . $date->format('Y');
        
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
        array_forget($data,'new');
        $table = new Formujiriksa;
        $table->fill($data);
        $table->save();

        // dd($request->itemujiriksa);
        if (isset($request->itemujiriksa)) { 
            foreach ($request->itemujiriksa as $key ) {
                
            if (isset($key['tube_id'])) {
                $item = new Itemujiriksa([
                    'jumlah_barang' => $key['jumlah_barang'],
                    'nama_barang' => $key['nama_barang'],
                    'tube_id' => $key['tube_id'],
                    'keluhan' => $key['keluhan']
                ]);
            }                
            elseif (isset($key['alat_id'])) {
                $item = new Itemujiriksa([
                    'jumlah_barang' => $key['jumlah_barang'],
                    'nama_barang' => $key['nama_barang'],
                    'alat_id' => $key['alat_id'],
                    'keluhan' => $key['keluhan']
                ]);
            } 
                $table->itemujiriksa()->save($item);

                // dd($request->hasFile($key['fototabung']));
                // if ($key->hasFile()) {
                    // isi field cover jika ada cover yg di upload
                // dd(isset($key['fototabung']));
                if (isset($key['fototabung'])) {
                    
                    //ambil file yang di upload
                    $uploaded =$key['fototabung'];
                    
                    foreach ($uploaded as $foto) {

                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        $destinationPath = storage_path('app/public/foto');
                        $foto->move($destinationPath, $filename);

                        // mengisi field foto tabung masuk dengan filename yg baru dibuat
                        
                        Fototabung::create([
                            'foto_tabung_masuk' => $filename,
                            'itemujiriksa_id' => $item->id
                            ]);
                    // }
                    }
                }
            }
        }

        $status = "";
        $this->savePdf($table->id, $status);

        Mail::send('ujiriksa.emailForm', compact('table'), function ($m) use ($table) {
            $m->to($table->customer->email, $table->customer->nama)->subject('Form Ujiriksa NDT Dive');
            $m->attach(storage_path('app/public/formuji/Form Ujiriksa-'. $table->id . '.pdf'));
        });
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Registrasi Ujiriksa dengan no Registrasi <b> $nouji </b> Berhasil"
            ]);

        if (isset($request->new)) {
            return redirect()->route('ujiriksa.create');
        }
        else {
            return redirect()->route('ujiriksa.index');
        }
    }

    public function storeAPI(Request $request) {
        // $this->validate($request, [
        //     'tube_id' => 'required|exists:tubes,id',
        //     'keluhan' => 'required|max:255',
        //     'jenis_uji' => 'required|max:255',
        //     'foto_tabung_masuk'=> 'image|max:8192',
        // ]);

        // request semua data
        $data = $request->except('keterangan_foto');
        // dd($request->all());

        // tarik jenis uji
        $jenisuji = $request->input('jenis_uji');

        $date = Carbon::parse('now');
        $counter = Formujiriksa::whereDate('created_at','=',date('Y-m-d'))->count()+1;
        // dd($counter);
        $kode = $date->format('dm').'-'. $counter . '/UJI/NDT/' . $date->format('Y');
        
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
        array_forget($data,'new');
        $table = new Formujiriksa;
        $table->fill($data);
        $table->save();

        if (isset($request->itemujiriksa)) { 
            foreach ($request->itemujiriksa as $key ) {
                // dd($key['tube_id'] == null);
            if (isset($key['tube_id'])) {
                $item = new Itemujiriksa([
                    'jumlah_barang' => $key['jumlah_barang'],
                    'nama_barang' => $key['nama_barang'],
                    'tube_id' => $key['tube_id'],
                    'keluhan' => $key['keluhan']
                ]);
            }                
            elseif (isset($key['alat_id'])) {
                $item = new Itemujiriksa([
                    'jumlah_barang' => $key['jumlah_barang'],
                    'nama_barang' => $key['nama_barang'],
                    'alat_id' => $key['alat_id'],
                    'keluhan' => $key['keluhan']
                ]);
            } 
                $table->itemujiriksa()->save($item);

                // dd($request->hasFile($key['fototabung']));
                // if ($key->hasFile()) {
                    // isi field cover jika ada cover yg di upload
                
                if (is_array($key['fototabung'])) {
                    
                    //ambil file yang di upload
                    $uploaded =$key['fototabung'];
                    
                    foreach ($uploaded as $foto) {

                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        $destinationPath = storage_path('app/public/foto');
                        $foto->move($destinationPath, $filename);

                        // mengisi field foto tabung masuk dengan filename yg baru dibuat
                        
                        Fototabung::create([
                            'foto_tabung_masuk' => $filename,
                            'itemujiriksa_id' => $item->id
                            ]);
                    // }
                    }
                }
            }
        }

        $status = "";
        $this->savePdf($table->id, $status);

        Mail::send('ujiriksa.emailForm', compact('table'), function ($m) use ($table) {
            $m->to($table->customer->email, $table->customer->nama)->subject('Form Ujiriksa NDT Dive');
            $m->attach(storage_path('app/public/formuji/Form Ujiriksa-'. $table->id . '.pdf'));
        });

        return response()->json(['error' => false, 'message' => 'Pendaftaran Tabung Masuk Berhasil']);

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

    public function showDetail(Request $request)
    {
        $data = Formujiriksa::with('itemujiriksa.tube','itemujiriksa.hydrostaticresult', 'itemujiriksa.visualresult', 'itemujiriksa.serviceresult', 'itemujiriksa.fototabung')->find($request['id']);
        if(!$data) {
            return response()->json(['error' => 'Data Alat Tidak Ada.'], 400);
        }
        else {
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tabungs = Tube::all();
        $alats = Alat::all();
        $selectedTubes = Itemujiriksa::where('formujiriksa_id',$id)->with('tube')->get();
        // dd($selectedTubes->tube->id);
        $ujiriksas = Formujiriksa::with('itemujiriksa.tube', 'itemujiriksa.fototabung')->findOrFail($id);
        return view('ujiriksa.edit')->with(compact('ujiriksas', 'tabungs', 'selectedTubes', 'alats'));
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
        $ujiriksas = Formujiriksa::with('itemujiriksa.tube','itemujiriksa.fototabung')->findOrFail($id);

        // $this->validate($request, [
        //     'tube_id' => 'required|exists:tubes,id',
        //     'keluhan' => 'required|max:255',
        //     'jenis_uji' => 'required|max:255',
        //     'foto_tabung_masuk'=> 'image|max:8192',
        // ]);

        // request semua data
        $data = $request->except('keterangan_foto');
        // dd($request->all());
        array_forget($data,'itemujiriksa');
        $ujiriksas->fill($data)->save();

        if (isset($request->itemujiriksa)) { 
            
            foreach ($request->itemujiriksa as $index => $key) {
                if (isset($key['tube_id'])) {
                    $item = new Itemujiriksa([
                        'jumlah_barang' => $key['jumlah_barang'],
                        'nama_barang' => $key['nama_barang'],
                        'tube_id' => $key['tube_id'],
                        'keluhan' => $key['keluhan']
                    ]);
                }                
                elseif (isset($key['alat_id'])) {
                    $item = new Itemujiriksa([
                        'jumlah_barang' => $key['jumlah_barang'],
                        'nama_barang' => $key['nama_barang'],
                        'alat_id' => $key['alat_id'],
                        'keluhan' => $key['keluhan']
                    ]);
                }

                $ujiriksas->itemujiriksa()->save($item);

                if (isset($key['fototabung'])) {
                    
                    //ambil file yang di upload
                    $uploaded =$key['fototabung'];
                    
                    foreach ($uploaded as $foto) {
                        // ambil extension file
                        $extension = $foto->getClientOriginalExtension();

                        // membuat nama file random
                        $filename = md5(str_random(8)) . '.' . $extension;

                        // simpan file ke folder storage/foto

                        $destinationPath = storage_path('app/public/foto');
                        $foto->move($destinationPath, $filename);

                        // mengisi field foto tabung masuk dengan filename yg baru dibuat
                        
                        Fototabung::create([
                            'foto_tabung_masuk' => $filename,
                            'itemujiriksa_id' => $item->id
                            ]);
                    }
                }

                if (isset($key['fototabung']) == false) {

                // reset itemujiriksa_id pada fototabung
                foreach ($ujiriksas->itemujiriksa as $index => $i) {  
                    
                    foreach($i->fototabung as $foto){
                        $foto->itemujiriksa_id = $item->id;
                        $foto->save();
                    }
                }
                $i->delete();

                // hapus fototabung
                // elseif(isset($key['fototabung'])) {
                //     foreach($i->fototabung as $foto){
                        
                //         $filepath = storage_path('app/public/foto/') . $foto->foto_tabung_masuk;

                //         try {
                //             File::delete($filepath);
                //         } catch (FileNotFoundException $e) {
                //             // file sudah tidak ada
                //         }
                //         $foto->delete();
                //     }
                // }
                }
            }
            
        }

        $status = "-update-" . Carbon::now()->format('dmYHis');
        $this->savePdf($ujiriksas->id, $status);

        Mail::send('ujiriksa.emailFormUpdate', compact('ujiriksas'), function ($m) use ($ujiriksas, $status) {
            $m->to($ujiriksas->customer->email, $ujiriksas->customer->nama)->subject('Form Ujiriksa NDT Dive Update');
            $m->attach(storage_path('app/public/formuji/Form Ujiriksa-'. $ujiriksas->id . $status .'.pdf'));
        });
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message" => "Perubahan Form Registrasi Ujiriksa Dengan Nomer Registrasi <b> $ujiriksas->no_registrasi </b>Berhasil"
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
        $ujiriksas = Formujiriksa::find($id);
        $ujiriksas->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" Form Ujiriksa <b> $ujiriksas->no_registrasi </b> Berhasil Dihapus!"
            ]);
        return redirect()->route('ujiriksa.index');
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
            if ($ujiriksas->jenis_uji == "Hydrostatic") {
                foreach($ujiriksas->itemujiriksa as $i) {
                    $i->tube->terakhir_hydrostatic = Carbon::today();
                    $i->tube->save();
                }
            }
            elseif ($ujiriksas->jenis_uji == "Visualstatic") {
                foreach($ujiriksas->itemujiriksa as $i) {
                    $i->tube->terakhir_visualstatic = Carbon::today();
                    $i->tube->save();
                }
            }
            elseif ($ujiriksas->jenis_uji == "Service") {
                if ($ujiriksas->is_service_alat === 0) {
                    foreach($ujiriksas->itemujiriksa as $i) {
                        $i->tube->terakhir_service = Carbon::today();
                        $i->tube->save();
                    }
                }
                else {
                    foreach($ujiriksas->itemujiriksa as $i) {
                        $i->alat->terakhir_service = Carbon::today();
                        $i->alat->save();
                    }
                }
                
            }

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
        $pengambil = $request->nama_pengambil;
        $ujiriksas->nama_pengambil = $pengambil;
        // dd($pengambil);
        
        $ujiriksas->save();
        // dd($ujiriksas);
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

    public function savePdf($id, $status) {
        $ujiriksas = Formujiriksa::with('customer','itemujiriksa.tube', 'user')->find($id);
        // dd($billings);
        $pdf = PDF::loadView('ujiriksa.pdf', compact('ujiriksas'));
        $filename = 'Form Ujiriksa-'. $ujiriksas->id . $status .'.pdf';

        if ($pdf->save(storage_path('app/public/formuji/'. $filename))) {
            return true;
            
        } else {
            return false;
        }
    }

    public function getDataTabung($id) {
        $tabungs = Tube::where('customer_id', $id)->paginate(15);
        foreach ($tabungs as $t) {
            $result[] = ['id' => $t->id, 'name' => $t->no_tabung ];
        }
        return response()->json($result);
    }

    public function getDataAlat($id) {
        $alats = Alat::where('customer_id', $id)->paginate(15);
        foreach ($alats as $at) {
            $result[] = ['id' => $at->id, 'name' => $at->no_alat ];
        }
        return response()->json($result);
    }

    public function changeStatusAPI(Request $request)
    {
        // dd($request->all());
        $ujiriksas = Formujiriksa::with('customer', 'itemujiriksa.tube')->find($request->id);
        // dd($ujiriksas);
        $status = $ujiriksas->progress;
        if($status == "Waiting List") {
            $ujiriksas->progress = "Sedang Dikerjakan";
            $ujiriksas->progress_at = Carbon::today();
            $ujiriksas->save();
            return response()->json(['error' => false, 'message' => 'Status Uji Telah Diperbaharui']);   
        }
        elseif($status == "Sedang Dikerjakan"){
            $ujiriksas->progress = "Selesai";
            $ujiriksas->done_at = Carbon::today();
            if ($ujiriksas->jenis_uji == "Hydrostatic") {
                foreach($ujiriksas->itemujiriksa as $i) {
                    $i->tube->terakhir_hydrostatic = Carbon::today();
                    $i->tube->save();
                }
            }
            elseif ($ujiriksas->jenis_uji == "Visualstatic") {
                foreach($ujiriksas->itemujiriksa as $i) {
                    $i->tube->terakhir_visualstatic = Carbon::today();
                    $i->tube->save();
                }
            }
            elseif ($ujiriksas->jenis_uji == "Service") {
                foreach($ujiriksas->itemujiriksa as $i) {
                    $i->tube->terakhir_service = Carbon::today();
                    $i->tube->save();
                }
            }

            Mail::send('ujiriksa.email', compact('ujiriksas'), function ($m) use ($ujiriksas) {
                $m->to($ujiriksas->customer->email, $ujiriksas->customer->nama)->subject('NDT Dive Laporan Pengerjaan');
            });
            $ujiriksas->save();

            return response()->json(['error' => false, 'message' => 'Status Uji Telah Diperbaharui Dan Email Berhasil Terkirim']);
        }
    }
}
