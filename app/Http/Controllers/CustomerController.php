<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Tube;
use App\Models\Alat;
use App\User;
use Session;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Excel;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $tabungs = Tube::with('customer')->orderBy('created_at', 'desc')->get();
        $alats = Alat::with('customer')->orderBy('created_at', 'desc')->get();
        return view('inventory.index', array(
            'customers' => $customers,
            'tabungs' => $tabungs,
            'alats' => $alats
            ));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->all();
        array_forget($data,'new');

        $customers = Customer::create($data);

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah data customer <b> $customers->nama </b>"
            ]);

        if (isset($request->new)) {
            return redirect()->route('customer.create');
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
        $customers = Customer::with(['tube.itemujiriksa.formujiriksa', 'alat.jenisalat','alat.merk'])->find($id);
        // $tabungs = Tube::where('customer_id', $id)->with(['itemujiriksa.formujiriksa'])->get();
        // dd($tabungs->itemujiriksa);
        return view('inventory.customer.show', array(
            'customers' => $customers
            // 'tabungs' => $tabungs
            ));

        // return view('customer.show')->with(compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::find($id);
        return view('inventory.customer.edit')->with(compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $customers = Customer::find($id);
        $customers->update($request->all());

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Data customer <b> $customers->nama </b> berhasil diperbaharui"
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
        $customers = Customer::findOrFail($id);
        $customers->delete();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Data Customer <b> $customers->nama </b> berhasil di hapus"
            ]);

        return redirect()->route('customer.index');
    }

    public function exportExcel() 
    {
        $customers = Customer::all();
        Excel::create('Data Customer NDT Dive', function($excel) use ($customers) {
            // Set property
            $excel->setTitle('Data Customer NDT Dive')
            ->setCreator(Auth::user()->name);
            $excel->sheet('Data Customer', function($sheet) use ($customers) {
                $row = 1;
                $sheet->row($row, [
                'Nama',
                'No Telpon',
                'Alamat',
                'Email',
                'Tanggal Member'
                ]);
                foreach ($customers as $c) {
                    $sheet->row(++$row, [
                    $c->nama,
                    $c->no_telp,
                    $c->alamat,
                    $c->email,
                    $c->tanggal_member
                    ]);
                }
            });
        })->export('xls');

        return redirect()->route('customer.index');
    }

    public function exportExcelDetail($id){

    $customers = Customer::with(['tube.itemujiriksa.formujiriksa'])->findOrFail($id);

    $export = Excel::create('Detail Customer '.$customers->nama, function($excel) use ($customers){
        $excel->setTitle('Data Detail Customer NDT Dive')->setCreator(Auth::user()->name);
        $excel->sheet($customers->nama, function($sheet) use ($customers){
            $sheet->loadView('inventory.customer.exportExcel',['customers'=>$customers]);
      });
    })->download('xls');

    return redirect()->route('customer.index');
   }
}
