<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Alat;
use App\Models\Jenisalat;
use App\Models\Tipe;
use App\Models\Merk;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckReminderTabung;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Olah;
use Illuminate\Support\Facades\File;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use CheckReminderTabung;
    public function index()
    {
        //
    }

    public function indexAll(Request $request) {
        $table = new Olah(Alat::with('customer', 'jenisalat'));

        $table->search(function($q) use ($request){
            if(isset($request->search) && $request->search != ''){
                $q->where('no_alat', 'LIKE', '%' . $request->search . '%');

            }
        });

        $table = $table->ambil();


        if(!$table) {
            return response()->json(['error' => 'Data Alat Tidak Ada.'], 400);
        }
        else {
            return response()->json($table);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.alat.create');
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
            'customer_id' => 'required|exists:customers,id',
            'jenisalat_id' => 'required|exists:jenisalats,id',
            'merk_id' => 'required|exists:merks,id',
            'tipe_id' => 'required|exists:tipes,id',
            'ukuran' => 'required|max:255',
            'warna' => 'required|max:255',
        ]);

        $data = $request->all();
        $jenis= Jenisalat::find($request->jenisalat_id);
        $merk= Merk::find($request->merk_id);
        $tipe= Tipe::find($request->tipe_id);
        $ukuran= $request->ukuran;
        $counter= Alat::where('customer_id', $request->customer_id)->count()+1;
        $noalat = $jenis->slugjenis . '-' . $merk->slugmerk . '-' . $tipe->slugtipe . '-' . $ukuran . '-' . $counter;
        $data['no_alat'] = $noalat;
        array_forget($data,'new');
        array_forget($data,'foto');
        $alats = Alat::create($data);

        if ($request->hasFile('foto')) {
            
            //ambil file yang di upload
            $uploaded_cover = $request->file('foto');

            // ambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = storage_path('app/public/foto');
            $uploaded_cover->move($destinationPath, $filename);

            // mengisi field cover di book dengan filename yg baru dibuat
            $alats->foto = $filename;
            $alats->save();


        }

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil Menambah Alat <b>" . $alats->jenisalat->nama_alat . "</b> Atas Nama Customer <b>". $alats->customer->nama . "</b>"
            ]);
        if (isset($request->new)) {
            return redirect()->route('alat.create');
        }
        else {
            return redirect()->route('customer.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alats = Alat::findOrFail($id);
        return view('inventory.alat.show')->with(compact('alats'));
    }

    public function showDetail($id)
    {
        $data = Alat::with('itemujiriksa.formujiriksa', 'customer','jenisalat', 'merk', 'tipe')->where('no_alat', $id)->orWhere('id', $id)->first();
        if(!$data) {
            return response()->json(['error' => true, 'message' => 'Data Alat Tidak Ada'], 400);
        }
        else {
            return response()->json(['error' => false, 'data' => $data]);
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
        $alats = Alat::findOrFail($id);
        return view('inventory.alat.edit')->with(compact('alats'));
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
            'customer_id' => 'required|exists:customers,id',
            'jenisalat_id' => 'required|exists:jenisalats,id',
            'merk_id' => 'required|exists:merks,id',
            'tipe_id' => 'required|exists:tipes,id',
            'ukuran' => 'required|max:255',
            'warna' => 'required|max:255',
        ]);

        $alats = Alat::findOrFail($id);
        $data = $request->all();
        if (!$alats->update($data)) return redirect()->back();

        if ($request->hasFile('foto')) {
            
            //ambil file yang di upload
            $uploaded_cover = $request->file('foto');

            // ambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();

            // membuat nama file random
            $filename = md5(time()) . '.' . $extension;

            // simpan file ke folder public/img

            $destinationPath = storage_path('app/public/foto');
            $uploaded_cover->move($destinationPath, $filename);

            //hapus cover lama jika ada

            if($alats->foto) {
                $old_cover = $alats->foto;
                $filepath = storage_path('app/public/foto' . $alats->foto);

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // file sudah tidak ada
                }
            }

            // mengisi field cover di book dengan filename yg baru dibuat
            $alats->foto = $filename;
            $alats->save();
        }

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Alat Dengan Nomer <b> $alats->no_alat </b> Berhasil Diubah"
        ]);

        return redirect()->route('customer.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alats = Alat::findOrFail($id);
        $alats->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Alat Dengan Nomer <b> $alats->no_alat </b> Berhasil Dihapus"
        ]);

        return redirect()->route('customer.index');
    }

    public function exportExcelDetail($id){

    $alats = Alat::with(['itemujiriksa.formujiriksa', 'jenisalat', 'merk', 'customer'])->findOrFail($id);

    $export = Excel::create('Detail Alat '.$alats->no_alat, function($excel) use ($alats){
        $excel->setTitle('Data Detail Alat NDT Dive')->setCreator(Auth::user()->name);
        $excel->sheet($alats->no_alat, function($sheet) use ($alats){
            $sheet->loadView('inventory.alat.exportExcelDetail',['alats'=>$alats]);
      });
    })->download('xls');

    return redirect()->route('customer.index');
   }

   public function reminder() {
    // $table = Alat::with(array('jenisalat' => function($query)
    // {
    //      $query->where('jenisalats.reminder', 1);
    // }))->get();

    $table = Alat::with('jenisalat', 'customer')
        ->whereHas('jenisalat', function($q) {
           // Query the name field in status table
           $q->where('reminder', '=', 1); // '=' is optional
        })->get();

    // $table = DB::table('jenisalats')
    //         ->join('alats', 'jenisalats.id', '=', 'alats.jenisalat_id')
    //         ->select('alats.*', 'jenisalats.reminder', 'jenisalats.nama_alat')
    //         ->where('reminder', 1)
    //         ->get();   

    $checkAlat = $this->checkAlat($table);
   }

   public function printBarcode($id) {
        $data = Alat::where('id', $id)->firstOrFail();
        // dd($data);
        $pdf = PDF::loadView('inventory.alat.barcode', compact('data'));
        $filename = 'Barcode-'.' '.$data->no_alat.'.pdf';
        return $pdf->inline();
    }

    public function exportExcel(){

    $alats = Alat::with(['jenisalat', 'merk', 'customer'])->get();

    $export = Excel::create('Data Alat Keseluruhan', function($excel) use ($alats){
        $excel->setTitle('Data Alat Keseluruhan NDT Dive')->setCreator(Auth::user()->name);
        $excel->sheet('Data Alat', function($sheet) use ($alats){
            $sheet->loadView('inventory.alat.exportExcel',['alats'=>$alats]);
      });
    })->download('xls');

    return redirect()->route('customer.index');
   }
}
