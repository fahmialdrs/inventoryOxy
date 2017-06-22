<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Merk;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_merk' => 'required|unique:merks|max:255',
        ]);

        $data = $request->all();
        
        $merkalat = new Merk;
        $merkalat->fill($data);
        $merkalat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah merk alat <b> $merkalat->nama_merk </b>"
            ]);

        return redirect()->route('jenisalat.index');
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
        $merkalats = Merk::findOrFail($id);
        $merkalat = Merk::all();
        return view('peralatan.merkalat.edit', array(
            'merkalats' => $merkalats,
            'merkalat' => $merkalat
            ));
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
            'nama_merk' => 'required|unique:merks|max:255',
        ]);

        $merkalat = Merk::find($id);
        if (!$merkalat->update($request->all())) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Merk Alat <b> $merkalat->nama_merk </b> Berhasil Diubah"
        ]);

        return redirect()->route('jenisalat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $merkalat = Merk::findOrFail($id);
        $merkalat->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Merk Alat <b> $merkalat->nama_merk </b> Berhasil Dihapus"
        ]);

        return redirect()->route('jenisalat.index');
    }
}
