<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formujiriksa;
use App\Models\Itemujiriksa;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        $hydros=[];
        $visuals=[];
        $servicets=[];
        $serviceas=[];

        $hydro = DB::table('itemujiriksas')
        ->join('formujiriksas', function ($join) {
            $join->on('itemujiriksas.formujiriksa_id', '=', 'formujiriksas.id');
        })
        ->where('jenis_uji', '=', 'Hydrostatic')
        ->select(DB::raw('count(*) as count'), DB::raw('YEAR(itemujiriksas.created_at) as year, MONTHNAME(itemujiriksas.created_at) as month'))
        ->groupby('year', 'month')
        ->whereRaw('YEAR(itemujiriksas.created_at) =' . Carbon::today()->year)
        ->get()->toArray();
        
        $hydro = array_column($hydro, 'count', 'month');

            
        foreach ($hydro as $bulan => $val) {

            foreach ($month as $key => $value) {
                // dd($key);
                if ($value == $bulan) {
                    array_push($hydros, $val);
                }
                else {
                    array_push($hydros, 0);
                }
            }
            // dd($hydros);
        }

        


        $visual = DB::table('itemujiriksas')
        ->join('formujiriksas', function ($join) {
            $join->on('itemujiriksas.formujiriksa_id', '=', 'formujiriksas.id');
        })
        ->where('jenis_uji', '=', 'Visualstatic')
        ->select(DB::raw('count(*) as count'), DB::raw('YEAR(itemujiriksas.created_at) as year, MONTHNAME(itemujiriksas.created_at) as month'))
        ->groupby('year', 'month')
        ->whereRaw('YEAR(itemujiriksas.created_at) =' . Carbon::today()->year)
        ->get()->toArray();

        $visual = array_column($visual, 'count', 'month');

        foreach ($visual as $bulan => $val) {

            foreach ($month as $key => $value) {
                // dd($key);
                if ($value == $bulan) {
                    array_push($visuals, $val);
                }
                else {
                    array_push($visuals, 0);
                }
            }
            // dd($visuals);
        }

        $servicet = DB::table('itemujiriksas')
        ->join('formujiriksas', function ($join) {
            $join->on('itemujiriksas.formujiriksa_id', '=', 'formujiriksas.id');
        })
        ->where('jenis_uji', '=', 'Service')
        ->where('is_service_alat', '=', 0)
        ->select(DB::raw('count(*) as count'), DB::raw('YEAR(itemujiriksas.created_at) as year, MONTHNAME(itemujiriksas.created_at) as month'))
        ->groupby('year', 'month')
        ->whereRaw('YEAR(itemujiriksas.created_at) =' . Carbon::today()->year)
        ->get()->toArray();

        $servicet = array_column($servicet, 'count', 'month');

        foreach ($servicet as $bulan => $val) {

            foreach ($month as $key => $value) {
                // dd($key);
                if ($value == $bulan) {
                    array_push($servicets, $val);
                }
                else {
                    array_push($servicets, 0);
                }
            }
            // dd($servicets);
        }

        $servicea = DB::table('itemujiriksas')
        ->join('formujiriksas', function ($join) {
            $join->on('itemujiriksas.formujiriksa_id', '=', 'formujiriksas.id');
        })
        ->where('jenis_uji', '=', 'Service')
        ->where('is_service_alat', '=', 1)
        ->select(DB::raw('count(*) as count'), DB::raw('YEAR(itemujiriksas.created_at) as year, MONTHNAME(itemujiriksas.created_at) as month'))
        ->groupby('year', 'month')
        ->whereRaw('YEAR(itemujiriksas.created_at) =' . Carbon::today()->year)
        ->get()->toArray();

        $servicea = array_column($servicea, 'count', 'month');

        foreach ($servicea as $bulan => $val) {

            foreach ($month as $key => $value) {
                // dd($key);
                if ($value == $bulan) {
                    array_push($serviceas, $val);
                }
                else {
                    array_push($serviceas, 0);
                }
            }
            // dd($serviceas);
        }

        return view ('home')->with('hydros', json_encode($hydros))
        ->with('visuals', json_encode($visuals))
        ->with('servicets', json_encode($servicets))
        ->with('serviceas', json_encode($serviceas));

    }

}
