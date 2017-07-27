@extends('layouts.app')

@section('title', 'Hasil Keseluruhan Hydrostatic |' )


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}"> Dashboard</a></li>
                <li><a href="{{ url('/admin/ujiriksa') }}"> Ujiriksa</a></li>
                <li><a href="{{ url("/admin/ujiriksa/show/$form->id") }}"> Detail Ujiriksa</a></li>
                <li class="active">Hasil Keseluruhan Hydrostatic {{ $form->no_registrasi }} </li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Hasil Keseluruhan Hydrostatic {{ $form->no_registrasi }}</h2>
                </div>
                <div class="panel-body" style="overflow:auto; ">
                    <!-- <a href="#" class="btn btn-primary">Edit</a> -->
                    <br><br><br>
                    <div class="col-md-8">
                        <table class="table table-responsive">
                            <tr>
                                <td>No Registrasi Uji</td>
                                <td>:</td>
                                <td>{{ $form->no_registrasi }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>:</td>
                                <td>{{ $form->customer->nama }}</td>
                            </tr>
                            <tr>
                                <td>No Registrasi Uji</td>
                                <td>:</td>
                                <td>{{ $form->customer->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Uji</td>
                                <td>:</td>
                                <td>{{ $form->progress_at->format('d-M-Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <table class="table table-bordered" style ="width:100%;">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2">No</th>
                                <th class="text-center" rowspan="2">Gas yang diisikan</th>
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
                                <th class="text-center" rowspan="2">Aksi</th>
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
                            <?php $a = 0; ?>
                            @foreach($hydro as $t)
                            <tr>
                                <td width="70%"><b> {{ $a+1 }}</b></td>            
                                <td>{{ $t->tube->gas_diisikan }}</td>
                                <td>{{ $t->tube->no_tabung }}</td>
                                <td>{{ $t->tube->kode_tabung }}</td>
                                <td>{{ $t->tube->warna_tabung }}</td>
                                <td>{{ $t->hydrostaticresult->tekanan_kerja }}</td>
                                <td>{{ $t->hydrostaticresult->tekanan_pemadatan }}</td>
                                <td>{{ $t->hydrostaticresult->pabrik_pembuat_tabung }}</td>
                                <td>{{ $t->hydrostaticresult->pabrik_pemakai_tabung }}</td>
                                <td>{{ $t->hydrostaticresult->berat_tercatat }}</td>
                                <td>{{ $t->hydrostaticresult->berat_sekarang }}</td>
                                <td>{{ $t->hydrostaticresult->selisih_min }}</td>
                                <td>{{ $t->hydrostaticresult->selisih_plus }}</td>
                                <td>{{ $t->hydrostaticresult->selisih_pers }}</td>
                                <td>{{ $t->tube->isi_tabung }}</td>
                                <td>{{ $t->hydrostaticresult->air_dipadatkan }}</td>
                                <td>{{ $t->hydrostaticresult->pemuaian_tetap_cm3 }}</td>
                                <td>{{ $t->hydrostaticresult->pemuaian_tetap_pers }}</td>
                                <td>{{ $t->hydrostaticresult->suara_pukulan }}</td>
                                <td>{{ $t->hydrostaticresult->keadaan_karat }}</td>
                                <td>{{ $t->hydrostaticresult->keadaan_luar }}</td>
                                <td>{{ $t->hydrostaticresult->masa_berpori }}</td>
                                <td>{{ $t->hydrostaticresult->keterangan }}</td>
                                <td><a href="{{ route('hydrostatic.edit', $t->hydrostaticresult->id) }}" class="btn btn-xs btn-primary">Edit</a></td>
                            </tr>
                            <?php $a++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection