@extends('layouts.app')

@section('title', 'Hasil Keseluruhan Service |' )


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}"> Beranda</a></li>
                <li><a href="#"> Ujiriksa</a></li>
                <li class="active">Hasil Keseluruhan Service {{ $form->no_registrasi }} </li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Hasil Keseluruhan Service {{ $form->no_registrasi }}</h2>
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
                                <td>{{ $form->progress_at->format('d-M-Y') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                @if(isset($service->tube_id))
                                <th class="text-center">No Tabung</th>
                                @else
                                <th class="text-center">No Alat</th>
                                @endif
                                <th class="text-center">Jumlah Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Keterangan Service</th>
                                <th class="text-center">Attachment Hasil Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 0; ?>
                            @foreach($service as $t)
                            <tr>
                                <td><b> {{ $a+1 }}</b></td>
                                @if(isset($t->tube_id))            
                                <td>{{ $t->tube->no_tabung }}</td>
                                @else
                                <td>{{ $t->alat->no_alat }}</td>
                                @endif
                                <td>{{ $t->jumlah_barang }}</td>
                                <td>{{ $t->nama_barang }}</td>
                                <td>{{ $t->keluhan }}</td>
                                <td>{{ $t->serviceresult->keterangan_service}}</td>
                                <td>
                                @foreach($t->serviceresult->fotoservice as $ft)
                                    @if($ft->foto_tabung_service != null)
                                    <img src="{{ asset('storage/foto/'.$ft->foto_tabung_service) }}" class="img-rounded" width="100" height="75">
                                    @else
                                        <iframe src="{{ asset('storage/foto/'.$ft->video_tabung_service) }}" frameborder="0"></iframe>
                                    @endif
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