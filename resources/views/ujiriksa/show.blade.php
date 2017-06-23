@extends('layouts.app')

@section('title', 'Detail Form Ujiriksa |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/ujiriksa') }}"> Layanan</a></li>
					<li class="active">Detail Form Layanan {{ $form->no_registrasi }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Form Layanan {{ $form->no_registrasi }}</h2>
					</div>
					<div class="panel-body">					
						<a href="{{ route('ujiriksa.edit', $form->id) }}" class="btn btn-primary">Edit</a>
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
									<td>{{ date("d-m-Y", strtotime($form->perkiraan_selesai)) }}</td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Pengerjaan</td>
									@if(isset($form->progress_at))
									<td>{{ $form->progress_at->format('d-m-Y') }}</td>
									@else
									<td>{{ "Belum Dikerjakan" }}</td>
									@endif
								</tr>
								<tr>
									<td class="text-muted">Tanggal Selesai</td>
									@if(isset($form->done_at))
									<td>{{ $form->done_at->format('d-m-Y') }}</td>
									@else
									<td>{{ "Belum Selesai" }}</td>
									@endif
								</tr>
								<tr>
									<td class="text-muted">Hasil Uji</td>
									 @if( $form->jenis_uji == "Hydrostatic")
									 @if($form->progress == "Selesai")
							            <td><a href="{{ route('hydrostatic.showAll', $form->id) }}">Hasil Keseluruhan Hydrostatic</a></td>
							        @else
							            <td>Hasil Belum di Input</td>
							        @endif
							        @endif

						            @if( $form->jenis_uji == "Visualstatic")
						            @if($form->progress == "Selesai")
						            <td><a href="{{ route('visualstatic.showAll', $form->id) }}">Hasil Keseluruhan Visualstatic</a></td>
						            @else
						            <td>Hasil Belum di Input</td>						            
						            @endif
						            @endif

						            @if( $form->jenis_uji == "Service")
						            @if($form->progress == "Selesai")
						            <td><a href="{{ route('service.showAll', $form->id) }}">Hasil Keseluruhan Service</a></td>
						            @else
						            <td>Hasil Belum di Input</td>				            
						            @endif
						            @endif
								</tr>
							</table>
						</div>
						@if ($itemujiriksa->first()->alat_id != null)
						<table class="table">
						    <thead>
						        <tr>
						        	<th>No</th>
						            <th>Jumlah Barang</th>
						            <th>Nama Barang</th>
						            <th>No Alat</th>
						            <th>Keluhan</th>
						            <th>Foto Barang Masuk</th>
						            <th>Hasil</th>
						        </tr>
						    </thead>
						    <tbody>
						    <?php $a = 0; ?>
						    @foreach ($itemujiriksa as $t)
						        <tr>
						        	<td><?php $a++ ?> {{ $a }}</td>
						            <td>{{ $t->jumlah_barang or '' }}</td>
						            <td>{{ $t->nama_barang or '' }}</td>
						            <td><a href="{{ route('alat.show', $t->alat->id) }}">{{ $t->alat->no_alat or '' }}</a></td>
						            <td>{{ $t->keluhan or '' }}</td>
						            <td>
						            	@foreach($t->fototabung as $foto)                     
					                        <img src="{{ asset('storage/foto/'.$foto->foto_tabung_masuk) }}" class="img-rounded" width="100" height="75">                    
					                   @endforeach
						            </td>

						            @if( $form->jenis_uji == "Hydrostatic")
						            @if(isset($t->hydrostaticresult))
						            <td><a href="{{ route('hydrostatic.show', $t->hydrostaticresult->id) }}">Hasil Hydrostatic</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif

						            @if( $form->jenis_uji == "Visualstatic")
						            @if(isset($t->visualresult))
						            <td><a href="{{ route('visualstatic.show', $t->visualresult->id) }}">Hasil Visualstatic</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif

						            @if( $form->jenis_uji == "Service")
						            @if(isset($t->serviceresult))
						            <td><a href="{{ route('service.show', $t->serviceresult->id) }}">Hasil Service</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif
						        </tr>
						    @endforeach
						    </tbody>
						</table>
						@elseif($itemujiriksa->first()->tube_id != null)
						<table class="table">
						    <thead>
						        <tr>
						        	<th>No</th>
						            <th>Jumlah Barang</th>
						            <th>Nama Barang</th>
						            <th>No Tabung</th>
						            <th>Keluhan</th>
						            <th>Foto Barang Masuk</th>
						            <th>Hasil</th>
						        </tr>
						    </thead>
						    <tbody>
						    <?php $a = 0; ?>
						    @foreach ($itemujiriksa as $t)
						        <tr>
						        	<td><?php $a++ ?> {{ $a }}</td>
						            <td>{{ $t->jumlah_barang or '' }}</td>
						            <td>{{ $t->nama_barang or '' }}</td>
						            <td><a href="{{ route('tabung.show', $t->tube->id) }}">{{ $t->tube->no_tabung or '' }}</a></td>
						            <td>{{ $t->keluhan or '' }}</td>
						            <td>
						            	@foreach($t->fototabung as $foto)                     
					                        <img src="{{ asset('storage/foto/'.$foto->foto_tabung_masuk) }}" class="img-rounded" width="100" height="75">                    
					                   @endforeach
						            </td>

						            @if( $form->jenis_uji == "Hydrostatic")
						            @if(isset($t->hydrostaticresult))
						            <td><a href="{{ route('hydrostatic.show', $t->hydrostaticresult->id) }}">Hasil Hydrostatic</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif

						            @if( $form->jenis_uji == "Visualstatic")
						            @if(isset($t->visualresult))
						            <td><a href="{{ route('visualstatic.show', $t->visualresult->id) }}">Hasil Visualstatic</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif

						            @if( $form->jenis_uji == "Service")
						            @if(isset($t->serviceresult))
						            <td><a href="{{ route('service.show', $t->serviceresult->id) }}">Hasil Service</a></td>
						            @else
						            <td>Hasil Belum di Input</td>
						            @endif						            
						            @endif
						        </tr>
						    @endforeach
						    </tbody>
						</table>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
