<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Itembilling;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\Mail;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::with('customer')->orderBy('created_at', 'desc')->get();
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
    public function store(StoreBillingRequest $request)
    {
        $data = $request->except(['alamat', 'email']);
        $counter = Billing::whereDate('created_at','=',date('Y-m-d'))->count()+1;        
        $date = Carbon::parse('now');
        $noinv = $date->format('dm').'-'. $counter . '/INV/NDT/EB/' .$date->format('m'). '/' .$date->format('y');
        // dd($noinv);
        $data['no_invoice'] = $noinv;
        $data['status'] = 'Belum Bayar';
        // dd($request->subtotal);
        array_forget($data,'itembiling');
        $table = new Billing;
        $table->fill($data);
        
        $table->save();
        

        if (isset($request->itembiling)) {
            foreach ($request->itembiling as $key ) {
                    $item = new Itembilling([
                        'quantity' => $key['quantity'],
                        'deskripsi' => $key['deskripsi'],
                        'unitprice' => $key['unitprice'],
                        'amount' => $key['amount']
                    ]);
                    $table->itembilling()->save($item);
                    // dd($data);
            }
        }

        $status = "";
        $this->savePdf($table->id, $status);

        Mail::send('billing.email', compact('table'), function ($m) use ($table) {
            $m->to($table->customer->email, $table->customer->nama)->subject('Invoice NDT Dive');
            $m->attach(storage_path('app/public/invoice/Invoice-'. $table->id . '.pdf'));
        });

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
        $billings = Billing::with('customer','itembilling')->findOrFail($id);
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
        $billings = Billing::with('itembilling')->findOrFail($id);
        
        
        $data = $request->except(['alamat', 'email']);
        // dd($data);
        // $counter = Billing::whereDate('created_at','=',date('Y-m-d'))->count()+1;        
        // $date = Carbon::parse('now');
        // $noinv = $date->format('dm').'-'. $counter . '/INV/NDT/EB/' .$date->format('m'). '/' .$date->format('y');
        // // dd($noinv);
        // $data['no_invoice'] = $noinv;
        // $data['status'] = $billings->status;
        // dd($request->subtotal);
        array_forget($data,'itembiling');
        
        $billings->fill($data)->save();
        

        if (isset($request->itembiling)) {
            foreach ($billings->itembilling as $i) {
                // dd($i);
                $i->delete();    
            }
            foreach ($request->itembiling as $key ) {
                    $item = new Itembilling([
                        'quantity' => $key['quantity'],
                        'deskripsi' => $key['deskripsi'],
                        'unitprice' => $key['unitprice'],
                        'amount' => $key['amount']
                    ]);
                    $billings->itembilling()->save($item);
                    // dd($data);
            }
        }
        $status = "-update-" . Carbon::today()->format('d-m-Y');
        $this->savePdf($billings->id, $status);

        Mail::send('billing.emailUpdate', compact('billings'), function ($m) use ($billings) {
            $m->to($billings->customer->email, $billings->customer->nama)->subject('Invoice NDT Dive Update');
            $m->attach(storage_path('app/public/invoice/Invoice-'. $billings->id . $status .'.pdf'));
        });

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
        $billings = Billing::find($id);
        $billings->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>" Invoice <b> $billings->no_invoice </b> Berhasil Dihapus!"
            ]);
        return redirect()->route('billing.index');
    }

    public function changeStatus($id)
    {
        $billings = Billing::find($id);
        $billings->status = "Sudah Bayar";

        $billings->save();

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Invoice <b> $billings->no_invoice </b> Sudah Dibayar"
            ]);

        return redirect()->route('billing.index');
    }

    public function exportPdf($id) {
        $billings = Billing::with('customer','itembilling')->find($id);
        // dd($billings);
        $pdf = PDF::loadView('billing.pdf', compact('billings'));
        $filename = 'Invoice-'.' '.$billings->no_invoice.'.pdf';
        return $pdf->stream($filename);
    }

    public function kirimEmail($id) {
        $table = Billing::with('itembilling', 'customer')->find($id);
        Mail::send('billing.email', compact('table'), function ($m) use ($table) {
            $m->to($table->customer->email, $table->customer->nama)->subject('Invoice NDT Dive');
            $m->attach($this->exportPdf($table->id));
        });

        Session::flash("flash_notification", [
            "level" => "success", 
            "message" => "Invoice <b> $table->no_invoice </b> Telah dikirim ke Email <b>". $table->customer->email . "</b>" 
            ]);

        return redirect()->route('billing.index');
    } 

    public function savePdf($id, $status) {
        $billings = Billing::with('customer','itembilling')->find($id);
        // dd($billings);
        $pdf = PDF::loadView('billing.pdf', compact('billings'));
        $filename = 'Invoice-'. $billings->id . $status .'.pdf';

        if ($pdf->save(storage_path('app/public/invoice/'. $filename))) {
            return true;
            
        } else {
            return false;
        }
    }
}
