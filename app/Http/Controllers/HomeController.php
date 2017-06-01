<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ujiriksa = [];
        $tabung = [];

        $customers = [];
        $tube = [];

        // dd(Formujiriksa::with('itemujiriksa')->get());
        foreach(Formujiriksa::with('itemujiriksa')->get() as $uji) {
                array_push($ujiriksa, $uji->jenis_uji);
                array_push($tabung, $uji->itemujiriksa->count());
            }

        foreach(Customer::with('tube')->get() as $cust) {
                array_push($customers, $cust->nama);
                array_push($tube, $cust->tube->count());
            }
        return view ('home')->with(compact('ujiriksa', 'tabung', 'customers', 'tube'));
    }

}
