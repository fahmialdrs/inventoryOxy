<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenisalat;
use App\Models\Merk;
use App\Models\Tipe;
use App\Models\Alat;
use Illuminate\Support\Facades\Session;

class JenisalatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisalat = Jenisalat::orderBy('nama_alat', 'asc')->get();
        $merkalat = Merk::orderBy('nama_merk', 'asc')->get();
        $tipealat = Tipe::orderBy('nama_tipe', 'asc')->get();
        return view('peralatan.index', array(
            'jenisalat' => $jenisalat,
            'merkalat' => $merkalat,
            'tipealat' => $tipealat
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peralatan.jenisalat.create');
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
            'nama_alat' => 'required|unique:jenisalats|max:255',
            'reminder'=>'required',
        ]);

        $data = $request->all();
        
        $jenisalat = new Jenisalat;
        $jenisalat->fill($data);
        $jenisalat->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah jenis alat <b> $jenisalat->nama_alat </b>"
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
        $jenisalats = Jenisalat::findOrFail($id);
        $jenisalat = Jenisalat::orderBy('nama_alat', 'asc')->get();
        return view('peralatan.jenisalat.edit', array(
            'jenisalat' => $jenisalat,
            'jenisalats' => $jenisalats
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
            'nama_alat' => 'required|max:255',
            'reminder'=>'required',
        ]);

        $jenisalat = Jenisalat::find($id);
        if (!$jenisalat->update($request->all())) return redirect()->back();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Jenis Alat <b> $jenisalat->nama_alat </b> Berhasil Diubah"
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
        $jenisalat = Jenisalat::findOrFail($id);
        $jenisalat->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data Jenis Alat <b> $jenisalat->nama_alat </b> Berhasil Dihapus"
        ]);

        return redirect()->route('jenisalat.index');
    }

    public function getDataJenis($id) {

        $alats = Alat::with('jenisalat')->find($id);
        $result[] = ['id' => $alats->id, 'nama_alat' => $alats->jenisalat->nama_alat];
        return response()->json($alats);

        // $customers = Customer::find($id);
        // return response()->json($customers);
    }
}
