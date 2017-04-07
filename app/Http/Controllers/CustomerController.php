<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
// use Yajra\Datatables\Html\Builder;
// use Yajra\Datatables\Datatables;
use Session;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
        // if ($request->ajax()) {
        //     $customer = Customer::select('id', 'nama','email', 'tgl_member');
        //     return Datatables::of($customer)->make(true);
        // }

        // $html = $htmlBuilder
        // ->addColumn(['data'=>'nama', 'name'=>'nama', 'title'=>'Nama'])
        // ->addColumn(['data'=>'email', 'name'=>'email', 'title'=>'Email'])
        // ->addColumn(['data'=>'tgl_member', 'name'=>'tgl_member', 'title'=>'Tanggal Member']);

        // return view('customer.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'nama' => 'required',
        //     'alamat' => 'required',
        //     'email' => 'required|unique:customers',
        //     'tgl_member' => 'required|date'
        //     ]);

        // $customer = Customer::create($request->all());
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message" => "Input <b> $customer->nama </b> as to Database is Success"
        //     ]);

        // return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $customer = Customer::find($id);

        // if (!$customer::destroy($id)) {
        //     return redirect()->back();
        // }
        // Session::flash("flash_notification", [
        //     "level"=>"success",
        //     "message"=>" <b> $customer->name </b> as Customer has been deleted!"
        //     ]);
        // return redirect()->route('customer.index');
    }
}
