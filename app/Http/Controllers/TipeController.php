<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Tipe;

class TipeController extends Controller
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
        return view('peralatan.tipealat.create');
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
            'nama_tipe' => 'required|unique:tipes|max:255',
        ]);

        $data = $request->all();
        
        $tipealat = new Tipe;
        $tipealat->fill($data);
        $tipealat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah tipe alat <b> $tipealat->nama_tipe </b>"
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
        $tipealats = Tipe::findOrFail($id);
        $tipealat = Tipe::orderBy('nama_tipe', 'asc')->get();
        return view('peralatan.tipealat.edit', array(
            'tipealats' => $tipealats,
            'tipealat' => $tipealat
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
            'nama_tipe' => 'required|max:255',
        ]);

        $tipealat = Tipe::find($id);
        if (!$tipealat->update($request->all())) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tipe Alat <b> $tipealat->nama_tipe </b> Berhasil Diubah"
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
        $tipealat = Tipe::findOrFail($id);
        $tipealat->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Tipe Alat <b> $tipealat->nama_tipe </b> Berhasil Dihapus"
        ]);

        return redirect()->route('jenisalat.index');
    }
}
