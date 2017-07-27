@extends('layouts.app')
@section('title', 'Import Hydrostatic')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
        <li><a href="{{ url('/admin/hydrostatic/create') }}">Input Hasil Hydrostatic</a></li>
        <li class="active">Review Hasil Hydrostatic</li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Review Hasil Hydrostatic</h2>
        </div>

        <div class="panel-body" style="overflow:auto; ">
          <p> <a class="btn btn-success" href="{{ url('/admin/ujiriksa')}}">Selesai</a> </p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" rowspan="2">No Registrasi</th>
                <th class="text-center" rowspan="2">Gas yang diisikan</th>
                <th class="text-center" rowspan="2">Terakhir Hydrostatic</th>
                <th class="text-center" colspan="3">Keterangan Tabung</th>
                <th class="text-center" rowspan="2">Tekanan Kerja (Kg/Cm<sup>2</sup>)</th>
                <th class="text-center" rowspan="2">Tekanan Pemadatan (Kg/Cm<sup>2</sup>)</th>
                <th class="text-center" rowspan="2">Nama Pabrik Pembuat Tabung</th>
                <th class="text-center" rowspan="2">Nama Pabrik Pemakai Tabung</th>
                <th class="text-center" rowspan="2">Berat Tabung Yang Tercatat (Kg)</th>
                <th class="text-center" rowspan="2">Berat Tabung Sekarang (kg)</th>
                <th class="text-center" colspan="3">Selisih</th>
                <th class="text-center" rowspan="2">Isi Tabung (Ltr)</th>            
                <th class="text-center" rowspan="2">Air yang dipadatkan (cm<sup>3</sup>)</th>
                <th class="text-center" colspan="2">Pemuaian Tetap</th>
                <th class="text-center" rowspan="2">Suara Pukulan</th>
                <th class="text-center" rowspan="2">Keadaan Karat</th>
                <th class="text-center" rowspan="2">Keadaan Luar</th>
                <th class="text-center" rowspan="2">Masa Berpori</th>
                <th class="text-center" rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th class="text-center">No Tabung</th>            
                <th class="text-center">Kode Tabung</th>
                <th class="text-center">Warna Tabung</th>
                <th class="text-center">-</th>
                <th class="text-center">+</th>
                <th class="text-center">%</th>
                <th class="text-center">cm<sup>3</sup></th>
                <th class="text-center">%</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($hasils as $hasil) 
                <tr>
                  <td>{{ $hasil->formujiriksa->no_registrasi }}</td>
                  <td>{{ $hasil->tube->gas_diisikan }}</td>
                  <td>{{ $hasil->tube->terakhir_hydrostatic }}</td>
                  <td>{{ $hasil->tube->no_tabung }}</td>
                  <td>{{ $hasil->tube->kode_tabung }}</td>
                  <td>{{ $hasil->tube->warna_tabung }}</td>
                  <td>{{ $hasil->hydrostaticresult->tekanan_kerja }}</td>
                  <td>{{ $hasil->hydrostaticresult->tekanan_pemadatan }}</td>
                  <td>{{ $hasil->hydrostaticresult->pabrik_pembuat_tabung }}</td>
                  <td>{{ $hasil->hydrostaticresult->pabrik_pemakai_tabung }}</td>
                  <td>{{ $hasil->hydrostaticresult->berat_tercatat }}</td>
                  <td>{{ $hasil->hydrostaticresult->berat_sekarang }}</td>
                  <td>{{ $hasil->hydrostaticresult->selisih_min }}</td>
                  <td>{{ $hasil->hydrostaticresult->selisih_plus }}</td>
                  <td>{{ $hasil->hydrostaticresult->selisih_pers }}</td>
                  <td>{{ $hasil->hydrostaticresult->itemujiriksa->tube->isi_tabung }}</td>
                  <td>{{ $hasil->hydrostaticresult->air_dipadatkan }}</td>
                  <td>{{ $hasil->hydrostaticresult->pemuaian_tetap_cm3 }}</td>
                  <td>{{ $hasil->hydrostaticresult->pemuaian_tetap_pers }}</td>
                  <td>{{ $hasil->hydrostaticresult->suara_pukulan }}</td>
                  <td>{{ $hasil->hydrostaticresult->keadaan_karat }}</td>
                  <td>{{ $hasil->hydrostaticresult->keadaan_luar }}</td>
                  <td>{{ $hasil->hydrostaticresult->masa_berpori }}</td>
                  <td>{{ $hasil->hydrostaticresult->keterangan }}</td>
                  <!-- <td><a href="{{ route('hydrostatic.destroy', $hasil->id) }}" class="btn btn-xs btn-danger">Hapus</a></td> -->
                </tr>
              @endforeach
            </tbody>
          </table>
          <p> <a class="btn btn-success" href="{{ url('/admin/ujiriksa')}}">Selesai</a> </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection