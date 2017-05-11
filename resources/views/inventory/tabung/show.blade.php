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
						<table class="table">
							<tr>
								<td class="text-muted">No Tabung</td>
								<td>{{ $tabungs->no_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Pemilik</td>
								<td><a href="{{ route('customer.show', $tabungs->customer_id) }}">{{ $tabungs->customer->nama }}</a></td>
							</tr>
							<tr>
								<td class="text-muted">Gas yang Diisikan</td>
								<td>{{ $tabungs->gas_diisikan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Kode Tabung</td>
								<td>{{ $tabungs->kode_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Warna Tabung</td>
								<td>{{ $tabungs->warna_tabung }} Liter</td>
							</tr>
							<tr>
								<td class="text-muted">Isi Tabung</td>
								<td>{{ $tabungs->isi_tabung }} Liter</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal PembuatanTabung</td>
								<td>{{ $tabungs->tanggal_pembuatan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Status Tabung</td>
								<td>{{ $tabungs->status }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Terakhir Hydrostatic</td>
								<td>{{ $tabungs->itemujiriksa->first()->done_at or '' }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Terakhir Visualstatic</td>
								<td>{{ $tabungs->itemujiriksa->first()->done_at or '' }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Terakhir Service</td>
								<td>{{ $tabungs->itemujiriksa->first()->done_at or '' }}</td>
							</tr>
						</table>
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
								<table id="history_tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Registrasi Kegiatan</th>
								            <th>Jenis Kegiatan</th>
								            <th>Keluhan</th>
								            <th>Tanggal Kegiatan</th>
								            <th>Attachment</th>
								            <th>Progress</th>
								            <th>Action</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs->itemujiriksa as $t)
								        <tr>
								            <td>{{ $t->formujiriksa->no_registrasi or '' }}</td>
								            <td>{{ $t->keluhan or '' }}</td>
								            <td>{{ $t->formujiriksa->jenis_uji or '' }}</td>
								            <td>{{ $t->formujiriksa->done_at or '' }}</td>
								            <td>file</td>
								            <td>{{ $t->formujiriksa->progress or '' }}</td>
								            <td>
												<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Action <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="#">Input Hasil Hydrostatic</a>
													  	</li>
													  	<li>
															<a type="button" href="#">Edit</a>
													  	</li>
													  	<li>
															<a type="button" href="#">Delete</a>
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
@endsection

@section('scripts')
	<script>
		$(document).ready( function () {
		    $('.display').dataTable( {
			  	"columnDefs": [ {
				    "targets": [ 4 ],
				    "searchable": false,
				    "orderable": false
			    } ]
		} );

		
			} );
	</script>
@endsection