@extends('layouts.app')

@section('title', 'Detail Alat |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/inventory') }}"> Data Inventory</a></li>
					<li class="active">Detail Alat {{ $alats->no_alat }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Alat <b>{{ $alats->no_alat }}</b></h2>
					</div>
					<div class="panel-body">
						<a href="{{ route('alat.edit', $alats->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md-6">
							<table class="table">
								<tr>
									<td class="text-muted">No Alat</td>
									<td>:</td>
									<td>{{ $alats->no_alat }}</td>
								</tr>
								<tr>
									<td class="text-muted">Nama Pemilik</td>
									<td>:</td>
									<td>{{ $alats->customer->nama }}</td>
								</tr>
								<tr>
									<td class="text-muted">Jenis Alat</td>
									<td>:</td>
									<td>{{ $alats->jenisalat->nama_alat }}</td>
								</tr>
								<tr>
									<td class="text-muted">Merk Alat</td>
									<td>:</td>
									<td>{{ $alats->merk->nama_merk }}</td>
								</tr>
								<tr>
									<td class="text-muted">Tipe Alat</td>
									<td>:</td>
									<td>{{ $alats->tipe->nama_tipe }}</td>
								</tr>
								<tr>
									<td class="text-muted">Ukuran Alat</td>
									<td>:</td>
									<td>{{ $alats->ukuran }}</td>
								</tr>
								<tr>
									<td class="text-muted">Warna Alat</td>
									<td>:</td>
									<td>{{ $alats->warna }}</td>
								</tr>
								<tr>
									<td class="text-muted">Terakhir Service</td>
									<td>:</td>
									<td>{{ $alats->terakhir_service->format('d-M-Y') }}</td>
								</tr>
								<tr>
									<td class="text-muted">Catatan</td>
									<td>:</td>
									<td>{{ $alats->catatan }}</td>
								</tr>
							</table>
						</div>

						<div class="col-md-12">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#history_alat" aria-controls="history_alat" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> History Alat
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="history_alat">
							<p class="pull-right"> 
								<a class="btn btn-warning" href="{{ route('alat.exportExcelDetail', $alats->id) }}">Export Data Detail Tabung</a>
							</p>
								<table id="histori_alat" class="display">
								    <thead>
								        <tr>
								            <th>No Registrasi Kegiatan</th>
								            <th>Jenis Kegiatan</th>
								            <th>Keluhan</th>
								            <th>Progress</th>
								            <th>Tanggal Kegiatan</th>
								            <th>Hasil</th>								            
								            <th>Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($alats->itemujiriksa as $t)								    
								        <tr>
								            <td>{{ $t->formujiriksa->no_registrasi or '' }}</td>
								            <td>{{ $t->formujiriksa->jenis_uji or '' }}</td>
								            <td>{{ $t->keluhan or '' }}</td>								            
								            <td>{{ $t->formujiriksa->progress or '' }}</td>
								            @if(isset($t->formujiriksa->done_at))
								            <td>{{ $t->formujiriksa->done_at->format('d-M-Y')  }}</td>
								            @else
								            <td>{{ "Belum Selesai" }}</td>
								            @endif
								            @if($t->formujiriksa->jenis_uji == "Service")
								            @if(isset($t->serviceresult))
											<td><a href="{{ route('service.show', $t->serviceresult->id) }}">Hasil</a></td>
											@else
											<td>Hasil Belum di Input</td>
								            @endif
											@endif
								            <td>
												<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Aksi <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="#">Export PDF</a>
													  	</li>
													  	<li role="separator" class="divider"></li>
													    <li><a href="#">Unduh Label</a></li>
													  </ul>
													</div>
												</div>
								            </td>
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
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready( function () {
		    $('#histori_alat').dataTable( {
		    	"order": [[ 4, "desc" ]],
			  	"columnDefs": [ {
				    "targets": [ 5, 6 ],
				    "searchable": false,
				    "orderable": false
			    } ]
		} );

		
			} );
	</script>
@endsection