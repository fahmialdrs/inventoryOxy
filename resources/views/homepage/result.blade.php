@extends('layouts.app')
@section('title', 'Hasil Ujiriksa')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}"> Beranda</a></li>
                    <!-- <li><a href="{{ url('/admin/ujiriksa') }}"> Ujiriksa</a></li> -->
                    <li class="active">Hasil Form Ujiriksa {{ $form->no_registrasi }} </li>
                </ul>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Detail Form Ujiriksa {{ $form->no_registrasi }}</h2>
                    </div>
                    <div class="panel-body" style="overflow:auto; ">                    
                        <br><br><br>
                        <div class="col-md-8">
                        <table class="table table-responsive">
                            <tr>
                                <td class="text-muted">No Registrasi</td>
                                <td>{{ $form->no_registrasi }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama Pelanggan</td>
                                <td>{{ $form->customer->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis uji</td>
                                <td>{{ $form->jenis_uji }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Keterangan</td>
                                <td>{{ $form->keterangan }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Progress</td>
                                <td>{{ $form->progress }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Perkiraan Selesai</td>
                                <td>{{ date("d-M-Y", strtotime($form->perkiraan_selesai)) }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Pengerjaan</td>
                                @if(isset($form->progress_at))
                                    <td>{{ $form->progress_at->format('d-M-Y') }}</td>
                                @else
                                    <td>Belum Dikerjakan</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Selesai</td>
                                @if(isset($form->done_at))
                                    <td>{{ $form->done_at->format('d-M-Y') }}</td>
                                @else
                                    <td>Belum Selesai</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-muted">Hasil Uji</td>
                                 @if( $form->jenis_uji == "Hydrostatic")
                                 @if($form->progress == "Selesai")
                                    <td><a href="{{ route('homepage.showAllHydrostatic', $form->id) }}">Hasil Keseluruhan Hydrostatic</a></td>
                                @else
                                    <td>Hasil Belum di Input</td>
                                @endif
                                @endif

                                @if( $form->jenis_uji == "Visualstatic")
                                @if($form->progress == "Selesai")
                                <td><a href="{{ route('homepage.showAllVisual', $form->id) }}">Hasil Keseluruhan Visualstatic</a></td>
                                @else
                                <td>Hasil Belum di Input</td>                                   
                                @endif
                                @endif

                                @if( $form->jenis_uji == "Service")
                                @if($form->progress == "Selesai")
                                <td><a href="{{ route('homepage.showAllService', $form->id) }}">Hasil Keseluruhan Service</a></td>
                                @else
                                <td>Hasil Belum di Input</td>                           
                                @endif
                                @endif
                            </tr>
                        </table>
                    </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Jumlah Barang</th>    -->                                 
                                    @if($form->is_service_alat == 0)
                                        <th>No Tabung</th>
                                    @else
                                        <th>No Alat</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                    @endif
                                    <th>Nama Barang</th>
                                    <th>Keluhan</th>
                                    <th>Foto</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $a = 0; ?>
                            @foreach ($form->itemujiriksa as $t)
                                <tr>
                                    <td><?php $a++ ?> {{ $a }}</td>
                                    <!-- <td>{{ $t->jumlah_barang or '' }}</td> -->
                                    @if($form->is_service_alat == 0)
                                        <td>{{ $t->tube->no_tabung or '' }}</td>
                                    @else
                                        <td>{{ $t->alat->no_alat or '' }}</td>
                                        <td>{{ $t->alat->merk->nama_merk or '' }}</td>
                                        <td>{{ $t->alat->tipe->nama_tipe or '' }}</td>
                                    @endif
                                    <td>{{ $t->nama_barang or '' }}</td>
                                    <td>{{ $t->keluhan or '' }}</td>
                                    <td>
                                        @foreach($t->fototabung as $foto)                     
                                            <img src="{{ asset('storage/foto/'.$foto->foto_tabung_masuk) }}" class="img-rounded" width="100" height="75">                    
                                       @endforeach
                                    </td>

                                    @if( $form->jenis_uji == "Hydrostatic")
                                    @if(isset($t->hydrostaticresult))
                                    <td><a href="{{ route('homepage.showHydrostatic', $t->hydrostaticresult->id) }}">Hasil Hydrostatic</a></td>
                                    @else
                                    <td>Hasil Belum di Input</td>
                                    @endif                                  
                                    @endif

                                    @if( $form->jenis_uji == "Visualstatic")
                                    @if(isset($t->visualresult))
                                    <td><a href="{{ route('homepage.showVisual', $t->visualresult->id) }}">Hasil Visualstatic</a></td>
                                    @else
                                    <td>Hasil Belum di Input</td>
                                    @endif                                  
                                    @endif

                                    @if( $form->jenis_uji == "Service")
                                    @if(isset($t->serviceresult))
                                    <td><a href="{{ route('homepage.showService', $t->serviceresult->id) }}">Hasil Service</a></td>
                                    @else
                                    <td>Hasil Belum di Input</td>
                                    @endif                                  
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
