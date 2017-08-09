<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Serviceresult;
use App\Models\Hydrostaticresult;
use App\Models\Visualresult;


class HomepageController extends Controller
{
    public function homepage()
    {
        return view('homepage.welcome');
    }

    public function result(Request $request)
    {
    	$this->validate($request, [
            'no_registrasi' => 'required|exists:formujiriksas,no_registrasi',

        ]);

    	$noreg = $request->no_registrasi;
        $form = Formujiriksa::where('no_registrasi', $noreg)->with('itemujiriksa.tube', 'itemujiriksa.fototabung', 'itemujiriksa.hydrostaticresult', 'itemujiriksa.visualresult.fotovisual', 'itemujiriksa.serviceresult.fotoservice')->firstOrFail();
        // dd($form);
        // $itemujiriksa = Itemujiriksa::where('formujiriksa_id', $form->id)->get();
        return view('homepage.result', array(
            'form' => $form
            // 'itemujiriksa' => $itemujiriksa
            ));

        return redirect()->route('homepage.result');
    }

    public function showHydrostatic($id)
    {
        $hydro = Hydrostaticresult::with(['itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        $form = Itemujiriksa::where('formujiriksa_id', $id)->firstOrFail();
        return view('homepage.showHydrostatic', array(
            'hydro' => $hydro,
            'form' => $form
            ));
    }
    public function showAllHydrostatic($id)
    {
        // $hydro = Formujiriksa::with(['itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        $form = Formujiriksa::with('customer')->find($id);
        $hydro = Itemujiriksa::where('formujiriksa_id', $id)->with('formujiriksa.customer','tube.customer', 'hydrostaticresult')->get();
        return view('homepage.showAllHydrostatic', array(
            'hydro' => $hydro,
            'form' => $form
            ));
    }

    public function showVisual($id)
    {
        $visual = Visualresult::with(['fotovisual','itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer'])->find($id);
        // $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('homepage.showVisual', array(
            'visual' => $visual
            ));
    }

    public function showAllVisual($id)
    {
        $form = Formujiriksa::with('customer')->find($id);
        $visual = Itemujiriksa::where('formujiriksa_id', $id)->with(['formujiriksa.customer','tube.customer', 'visualresult.fotovisual'])->get();
        return view('homepage.showAllVisual', array(
            'visual' => $visual,
            'form' => $form
            ));
    }

    public function showService($id)
    {
        $service = Serviceresult::with(['fotoservice','itemujiriksa.formujiriksa', 'itemujiriksa.tube.customer', 'itemujiriksa.alat.customer'])->find($id);
        // $form = Itemujiriksa::where('formujiriksa_id', $id)->get();
        return view('homepage.showService', array(
            'service' => $service
            ));
    }

    public function showAllService($id)
    {
        $form = Formujiriksa::with('customer')->find($id);
        $service = Itemujiriksa::where('formujiriksa_id', $id)->with(['formujiriksa.customer','tube.customer', 'alat.customer', 'serviceresult.fotoservice'])->get();
        // dd($service);
        return view('homepage.showAllService', array(
            'service' => $service,
            'form' => $form
            ));
    }
}
