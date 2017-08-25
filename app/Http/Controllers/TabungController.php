<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tube;
use App\Models\Alat;
use App\Models\Customer;
use App\Models\Itemujiriksa;
use Session;
use App\Http\Requests\StoreTabungRequest;
use App\Http\Requests\UpdateTabungRequest;
use PDF;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckReminderTabung;
use App\Models\Olah;

class TabungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use CheckReminderTabung;
    public function index()
    {
        $tabungs = Tube::with('customer')->orderBy('created_at', 'desc')->get();
        return view('inventory.tabung.index')->with(compact('tabungs'));
    }

    public function indexAll(Request $request) {
        $table = new Olah(Tube::with('customer'));

        $table->search(function($q) use ($request){
            if(isset($request->search) && $request->search != ''){
                $q->where('no_tabung', 'LIKE', '%' . $request->search . '%');

            }
        });

        $table = $table->ambil();


        if(!$table) {
            return response()->json(['error' => 'Data Tabung Tidak Ada.'], 400);
        }
        else {
            return response()->json($table);
        }

        // if(!$data) {
        //     return response()->json(['error' => 'Data Tabung Tidak Ada.'], 400);
        // }
        // else {
        //     return response()->json($data);
        // }
    }

    public function search($id){

      $tube = Tube::where('no_tabung', 'LIKE', '%' . $id . '%')->get();
      $alat = Alat::where('no_alat', 'LIKE', '%' . $id . '%')->get();

      $data = array('tube' => $tube,
                  'alat' => $alat
                  );

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('inventory.tabung.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTabungRequest $request)
    {
        $data = $request->all();
        array_forget($data,'new');
        $tabungs = Tube::create($data);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data Tabung untuk Customer <b>". $tabungs->customer->nama ."</b> dengan nomer tabung <b> $tabungs->no_tabung </b>."
            ]);

        if (isset($request->new)) {
            return redirect()->route('tabung.create');
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
        $tabungs = Tube::with(['itemujiriksa.formujiriksa','customer.billing'])->findOrFail($id);
        return view('inventory.tabung.show')->with(compact('tabungs'));
    }

    public function showDetail($id)
    {
        $data = Tube::with(['itemujiriksa.formujiriksa', 'customer'])->where('no_tabung', $id)->orWhere('id', $id)->first();
        if(!$data) {
            return response()->json(['error' => true, 'message' => 'Data Tabung Tidak Ada'], 400);
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
        $tabungs = Tube::find($id);
        return view('inventory.tabung.edit')->with(compact('tabungs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTabungRequest $request, $id)
    {
        $tabungs = Tube::find($id);

        $tabungs->update($request->all());

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Data tabung <b> $tabungs->no_tabung </b> berhasil diperbaharui"
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
        $tabungs = Tube::findOrFail($id);

        $tabungs->delete();

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Data tabung <b> $tabungs->no_tabung </b> berhasil dihapus"
            ]);

        return redirect()->route('customer.index');
    }

    public function printBarcode($id) {
        $data = Tube::where('id', $id)->firstOrFail();
        // dd($data);
        $pdf = PDF::loadView('inventory.tabung.barcode', compact('data'));
        $filename = 'Barcode-'.' '.$data->no_tabung.'.pdf';
        return $pdf->inline();
    }

    public function exportExcel() 
    {
        $tabungs = Tube::all();
        Excel::create('Data Tabung NDT Dive', function($excel) use ($tabungs) {
            // Set property
            $excel->setTitle('Data Tabung NDT Dive')
            ->setCreator(Auth::user()->name);
            $excel->sheet('Data Tabung', function($sheet) use ($tabungs) {
                $row = 1;
                $sheet->row($row, [
                'No Tabung',
                'Nama Pemilik',
                'Gas yang Diisikan',
                'Kode Tabung',
                'Isi Tabung',
                'Tanggal Pembuatan Tabung',
                'Status Tabung',
                'Tanggal Terakhir Hydrostatic',
                'Tanggal Terakhir Visualstatic',
                'Tanggal Terakhir Service'
                ]);
                foreach ($tabungs as $t) {
                    $sheet->row(++$row, [
                    $t->no_tabung,
                    $t->customer->nama,
                    $t->gas_diisikan,
                    $t->kode_tabung,
                    $t->isi_tabung . " liter",
                    $t->tanggal_pembuatan,
                    $t->status,
                    $t->terakhir_hydrostatic->format('d-m-Y'),
                    $t->terakhir_visualstatic->format('d-m-Y'),
                    $t->terakhir_service->format('d-m-Y')   
                    ]);
                }
            });
        })->export('xls');

        return redirect()->route('customer.index');
    }

    public function  exportExcelDetail($id){

    $tabungs = Tube::with('itemujiriksa.formujiriksa','customer.billing')->findOrFail($id);

    $export = Excel::create('Detail Tabung '.$tabungs->no_tabung, function($excel) use ($tabungs){
        $excel->setTitle('Data Detail Tabung NDT Dive')->setCreator(Auth::user()->name);
        $excel->sheet($tabungs->no_tabung, function($sheet) use ($tabungs){
            $sheet->loadView('inventory.tabung.exportExcel',['tabungs'=>$tabungs]);
      });
    })->download('xls');

    return redirect()->route('customer.index');
   }

   public function reminder() {
    $this->table = new Tube;

    $checkHydro = $this->checkTabung();
    $checkVisual = $this->checkTabungVisual();
   }
}
