@extends('layouts.app')
@section('title', 'Import Hydrostatic')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="{{ url('/home') }}">Dashboard</a></li>
        <li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
        <li><a href="{{ url('/admin/hydrostatic/create') }}">Input Hasil Hydrostatic</a></li>
        <li class="active">Review Hasil Hydrostatic</li>
      </ul>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">Review Hasil Hydrostatic</h2>
        </div>

        <div class="panel-body">
          <p> <a class="btn btn-success" href="{{ url('/admin/ujiriksa')}}">Done</a> </p>
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>No Registrasi Uji</th>
                <th>Gas Yang Diisikan</th>
                <th>Tanggal Pemadatan Terakhir</th>
                <th>No Seri Tabung</th>
                <th>Kode</th>
                <th>Warna Cat</th>
                <th>Tekanan Kerja</th>
                <th>Tekanan Pemadatan</th>
                <th>Nama Pabrik Pembuat Tabung</th>
                <th>Nama Pabrik Pemakai Tabung</th>
                <th>Berat Yang Tercatat</th>
                <th>Berat Timbangan Sekarang</th>
                <th>Selisih (-)</th>
                <th>Selisih (+)</th>
                <th>Selisih (%)</th>
                <th>Isi Tabung</th>
                <th>Air Yang Dipadatkan</th>
                <th>Pemuaian Tetap (cm3)</th>
                <th>Pemuaian Tetap (%)</th>
                <th>Suara Pukulan</th>
                <th>Keadaan Karat</th>
                <th>Keadaan Luar</th>
                <th>Masa Berpori</th>
                <th>Keterangan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($hasils as $hasil)
                <tr>
                  <td>{{ $hasil->no_registrasi }}</td>
                  <td>{{ $hasil->tube->gas_diisikan }}</td>
                  <td>{{ $hasil->tube->terakhir_hydrostatic }}</td>
                  <td>{{ $hasil->tube->no_tabung }}</td>
                  <td>{{ $hasil->tube->kode_tabung }}</td>
                  <td>{{ $hasil->tube->warna_tabung }}</td>
                  <td>{{ $hasil->tekanan_kerja }}</td>
                  <td>{{ $hasil->tekanan_pemadatan }}</td>
                  <td>{{ $hasil->pabrik_pembuat_tabung }}</td>
                  <td>{{ $hasil->pabrik_pemakai_tabung }}</td>
                  <td>{{ $hasil->berat_tercatat }}</td>
                  <td>{{ $hasil->berat_sekarang }}</td>
                  <td>{{ $hasil->selisih- }}</td>
                  <td>{{ $hasil->selisih+ }}</td>
                  <td>{{ $hasil->selisih% }}</td>
                  <td>{{ $hasil->tube->isi_tabung }}</td>
                  <td>{{ $hasil->air_dipadatkan }}</td>
                  <td>{{ $hasil->pemuaian_tetap_cm3 }}</td>
                  <td>{{ $hasil->pemuaian_tetap_% }}</td>
                  <td>{{ $hasil->suara_pukulan }}</td>
                  <td>{{ $hasil->keadaan_karat }}</td>
                  <td>{{ $hasil->keadaan_luar }}</td>
                  <td>{{ $hasil->masa_berpori }}</td>
                  <td>{{ $hasil->keterangan }}</td>
                  <td>
                    {!! Form::open(['url' => route('Hydrostatic.destroy', $hasil->id),
                    'id'           => 'form-'.$hasil->id, 'method'=>'delete',
                    'data-confirm' => 'Apa anda yakin ingin menghapus hasil dengan no registrasi ' . $hasil->no_registrasi . '?',
                    'class'        => 'form-inline js-review-delete']) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-xs btn-danger']) !!}
                    {!! Form::close() !!}
                  </td>
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