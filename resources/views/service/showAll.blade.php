@extends('layouts.app')

@section('title', 'Hasil Keseluruhan Service |' )


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
                <li><a href="{{ url('/admin/ujiriksa') }}"> Layanan</a></li>
                <li><a href="{{ url("/admin/ujiriksa/show/$form->id") }}"> Detail Layanan</a></li>
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
                    @if($form->is_service_alat == 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">No Tabung</th>
                                <th class="text-center">Jumlah Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Keterangan Service</th>
                                <th class="text-center">Foto Hasil Service</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 0; ?>
                            @foreach($service as $t)
                            <tr>
                                <td><b> {{ $a+1 }}</b></td>            
                                <td>{{ $t->tube->no_tabung }}</td>
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
                                <td><a href="{{ route('service.edit', $t->serviceresult->id) }}" class="btn btn-xs btn-primary">Edit</a></td
                            </tr>
                            <?php $a++ ?>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">No Alat</th>
                                <th class="text-center">Jumlah Barang</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Keterangan Service</th>
                                <th class="text-center">Attachment Hasil Service</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a = 0; ?>
                            @foreach($service as $t)
                            <tr>
                                <td><b> {{ $a+1 }}</b></td>            
                                <td>{{ $t->alat->no_alat }}</td>
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
                                <td><a href="{{ route('service.edit', $t->serviceresult->id) }}" class="btn btn-xs btn-primary">Edit</a></td
                            </tr>
                            <?php $a++ ?>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/videre.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/videre.js') }}"></script>
@endsection