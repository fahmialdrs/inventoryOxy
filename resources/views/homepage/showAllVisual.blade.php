@extends('layouts.app')

@section('title', 'Hasil Keseluruhan Visualstatic |' )


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"> Beranda</a></li>
                <li><a href="#"> Ujiriksa</a></li>
                <li class="active">Hasil Keseluruhan Visual {{ $form->no_registrasi }} </li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Hasil Keseluruhan Visual {{ $form->no_registrasi }}</h2>
                </div>
                <div class="panel-body" style="overflow:auto; ">
                    <!-- <a href="#" class="btn btn-primary">Edit</a> -->
                    <br><br>
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
                                <td>{{ $form->progress_at }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">No Tabung</th>
                                <th class="text-center">Jumlah Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Keterangan Visual</th>
                                <th class="text-center">Foto Hasil Visual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 0; ?>
                            @foreach($visual as $t)
                            <tr>
                                <td><b> {{ $a+1 }}</b></td>            
                                <td>{{ $t->tube->no_tabung }}</td>
                                <td>{{ $t->jumlah_barang }}</td>
                                <td>{{ $t->nama_barang }}</td>
                                <td>{{ $t->keluhan }}</td>
                                <td>{{ $t->visualresult->keterangan_visual}}</td>
                                <td>
                                @foreach($t->visualresult->fotovisual as $ft)
                                    {{ $ft->foto_tabung_visual }}<br>
                                @endforeach
                                </td>
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