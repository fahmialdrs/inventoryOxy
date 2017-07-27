<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Alat;
use App\Models\Jenisalat;
use App\Models\Tipe;
use Carbon\Carbon;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckReminderTabung;
use Illuminate\Support\Facades\DB;
use PDF;

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

    public function indexAll() {
        $data = Alat::with('customer')->orderBy('created_at', 'desc')->get();
        if(!$data) {
            return response()->json(['error' => 'Data Alat Tidak Ada.'], 400);
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

        $noalat = Carbon::now()->format('dmyhis');
        $data = $request->all();
        $data['no_alat'] = $noalat;
        array_forget($data,'new');

        $alats = Alat::create($data);

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
        $data = Alat::with(['itemujiriksa.formujiriksa'])->findOrFail($id);
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
            'tipe' => 'required|max:255',
            'ukuran' => 'required|max:255',
            'warna' => 'required|max:255',
        ]);

        $alats = Alat::findOrFail($id);
        if (!$alats->update($request->all())) return redirect()->back();

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
