<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Itembilling;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::with('customer')->get();
        return view('billing.index')->with(compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('billing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['alamat', 'email']);
        $data['no_invoice'] = "INV-" . Carbon::now();
        $data['status'] = 'Terkirim';

        array_forget($data,'itembiling');
        $table = new Billing;
        $table->fill($data);
        $table->save();
        // dd($data);
        // $input = $request->except(['tanggal_invoice', 'customer_id', 'alamat', 'email', 'perihal', 'subtotal', , 'ongkir', , 'discount', , 'email', 'total', 'terbilang']);
        // $input['billing_id'] = $billings->id;

        if (isset($request->itembiling)) {
            foreach ($request->itembiling as $key ) {
                    $item = new Itembilling([
                        'quantity' => $key['quantity'],
                        'deskripsi' => $key['deskripsi'],
                        'unitprice' => $key['unitprice'],
                        'amount' => $key['amount']
                    ]);
                    $table->itembilling()->save($item);
                    // dd($item);
            }
        }        

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil membuat invoice dengan nomer <b> $table->no_invoice </b>"
            ]);

        return redirect()->route('billing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billings = Billing::find($id);
        $itembillings = Itembilling::where('billing_id', $id)->get();
        return view('billing.show', array(
            'billings' => $billings,
            'itembillings' => $itembillings
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
        $billings = Billing::with('customer')->findOrFail($id);
        return view('billing.edit')->with(compact('billings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillingRequest $request, $id)
    {
        $billings = Billing::findOrFail($id);
        if (!$billings->update($request->except(['alamat', 'email', 'quantity', 'deskripsi', 'unitprice', 'amount']))) return redirect()->back();

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Invoice <b> $billings->no_invoice </b> berhasil diperbaharui"
            ]);

        return redirect()->route('billing.index');
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
