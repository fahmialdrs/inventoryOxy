@extends('layouts.app')

@section('title', 'Detail Tabung |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/customer') }}"> Data Inventory</a></li>
					<li class="active">Detail Tabung {{ $tabungs->no_tabung }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Tabung {{ $tabungs->no_tabung }}</h2>
					</div>
					<div class="panel-body">
						<a href="{{ route('tabung.edit', $tabungs->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md-6">
							<table class="table">
								<tr>
									<td class="text-muted">No Tabung</td>
									<td>:</td>
									<td>{{ $tabungs->no_tabung }}</td>
								</tr>
								<tr>
									<td class="text-muted">Pemilik</td>
									<td>:</td>
									<td><a href="{{ route('customer.show', $tabungs->customer_id) }}">{{ $tabungs->customer->nama }}</a></td>
								</tr>
								<tr>
									<td class="text-muted">Gas yang Diisikan</td>
									<td>:</td>
									<td>{{ $tabungs->gas_diisikan }}</td>
								</tr>
								<tr>
									<td class="text-muted">Kode Tabung</td>
									<td>:</td>
									<td>{{ $tabungs->kode_tabung }}</td>
								</tr>
								<tr>
									<td class="text-muted">Warna Tabung</td>
									<td>:</td>
									<td>{{ $tabungs->warna_tabung }}</td>
								</tr>
								<tr>
									<td class="text-muted">Isi Tabung</td>
									<td>:</td>
									<td>{{ $tabungs->isi_tabung }} Liter</td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Pembuatan Tabung</td>
									<td>:</td>
									<td>{{ date("d-M-Y", strtotime($tabungs->tanggal_pembuatan)) }}</td>
								</tr>
								<tr>
									<td class="text-muted">Status Tabung</td>
									<td>:</td>
									<td>{{ $tabungs->status }}</td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Terakhir Hydrostatic</td>
									<td>:</td>
									<td>{{ $tabungs->terakhir_hydrostatic->format('d-M-Y') }}</td>
								</tr>
								<tr>
									<td class="text-muted"><b>Tanggal Selanjutnya Hydrostatic</b></td>
									<td>:</td>
									<td><b>{{ $tabungs->terakhir_hydrostatic->addYears(1)->format('d-M-Y') }}</b></td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Terakhir Visualstatic</td>
									<td>:</td>
									<td>{{ $tabungs->terakhir_visualstatic->format('d-M-Y') }}</td>
								</tr>
								<tr>
									<td class="text-muted"><b>Tanggal Selanjutnya Visualstatic</b></td>
									<td>:</td>
									<td><b>{{ $tabungs->terakhir_visualstatic->addYears(1)->format('d-M-Y') }}</b></td>
								</tr>
								<tr>
									<td class="text-muted">Tanggal Terakhir Service</td>
									<td>:</td>
									<td>{{ $tabungs->terakhir_service->format('d-M-Y') }}</td>
								</tr>
							</table>
						</div>
						<div class="col-md-12">
						<ul class="nav nav-tabs" role="tablist">
							<!-- <li role="presentation" class="active">
								<a href="#laporan_tabung" aria-controls="laporan_tabung" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Laporan Data Tabung
								</a>
							</li> -->
							<li role="presentation" class="active">
								<a href="#history_tabung" aria-controls="history_tabung" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> History Tabung
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<!-- <div class="tab-pane active" role="tabpanel" id="laporan_tabung">
								<table id="laporan_tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Tanggal Pembuatan</th>
								            <th>Terakhir Ujiriksa</th>
								            <th>Status</th>
								            <th class="action">Action</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs as $t)
								        <tr>
								            <td><a href="#">No tabung</a></td>
								            <td>tgl pembuatan</td>
								            <td>tgl uji</td>
								            <td>status</td>
								            <td>
								            	<form method="POST" action="#" accept-charset="UTF-8">
						                            <input name="_method" type="hidden" value="DELETE">
						                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
						                            <a href="#" class="btn btn-xs btn-primary">Edit</a>
				                        			<input type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete">
				                        		</form>
								            </td>
								        </tr>
								    @endforeach
								    </tbody>
								</table>
							</div> -->
							<div class="tab-pane active" role="tabpanel" id="history_tabung">
							<p class="pull-right"> 
								<a class="btn btn-warning" href="{{ route('tabung.exportExcelDetail', $tabungs->id) }}">Export Data Detail Tabung</a>
							</p>
								<table id="history_tabung" class="display">
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
								    @foreach ($tabungs->itemujiriksa as $t)								    
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
								            @if($t->formujiriksa->jenis_uji == "Hydrostatic")
									            @if(isset($t->hydrostaticresult))
									            <td><a href="{{ route('hydrostatic.show', $t->hydrostaticresult->id) }}">Hasil</a></td>
									            @else
									            <td>Hasil Belum di Input</td>
									            @endif
								            @elseif($t->formujiriksa->jenis_uji == "Visualstatic")
									            @if(isset($t->visualresult))
									            <td><a href="{{ route('visualstatic.show', $t->visualresult->id) }}">Hasil</a></td>
									            @else
									            <td>Hasil Belum di Input</td>
									            @endif
								            @elseif($t->formujiriksa->jenis_uji == "Service")
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
		    $('.display').dataTable( {
		    	"order": [[ 4, "desc" ]],
			  	"columnDefs": [ {
				    "targets": [ 5,6 ],
				    "searchable": false,
				    "orderable": false
			    },
	    {
	    	"type": "date-dd-mmm-yyyy", targets :[4]
	    } ]
		} );

		
			} );
	</script>
@endsection