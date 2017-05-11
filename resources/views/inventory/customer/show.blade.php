@extends('layouts.app')

@section('title', 'Detail Customer |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/customer') }}"> Data Inventory</a></li>
					<li class="active">Detail Customer {{ $customers->nama }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Customer <b>{{ $customers->nama }}</b></h2>
					</div>
					<div class="panel-body">
						<a href="{{ route('customer.edit', $customers->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<table class="table">
							<tr>
								<td class="text-muted">Nama</td>
								<td>{{ $customers->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Email</td>
								<td>{{ $customers->email }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Telp</td>
								<td>{{ $customers->no_telp }}</td>
							</tr>
							<tr>
								<td class="text-muted">Alamat</td>
								<td>{{ $customers->alamat }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Member</td>
								<td>{{ $customers->tanggal_member }}</td>
							</tr>
						</table>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#data_tabung" aria-controls="data_tabung" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Tabung
								</a>
							</li>
							<li role="presentation">
								<a href="#history" aria-controls="history" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> History
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="data_tabung">
								<table id="tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Kandungan Gas</th>
								            <th>Terakhir Hydrostatic</th>
								            <th>Terakhir Visualstatic</th>
								            <th>Status</th>
								            <th class="action">Action</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs as $t)
								        <tr>
								            <td><a href="{{ route('tabung.show',$t->id) }}">{{ $t->no_tabung }}</a></td>
								            <td>{{ $t->gas_diisikan }}</td>
								            <td>{{ $t->terakhir_hydrostatic }}</td>
								            <td>{{ $t->terakhir_visualstatic }}</td>
								            <td>{{ $t->status }}</td>
								            <td>
								            	<form method="POST" action="{{ route('tabung.destroy', $t->id) }}" accept-charset="UTF-8">
						                            <input name="_method" type="hidden" value="DELETE">
						                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
						                            <a href="{{ route('tabung.edit',$t->id) }}" class="btn btn-xs btn-primary">Edit</a>
				                        			<input type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete">
				                        		</form>
								            </td>
								        </tr>
								    @endforeach
								    </tbody>
								</table>
							</div>
							<div class="tab-pane" role="tabpanel" id="history">
								<table id="history" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Jenis Kegiatan</th>
								            <th>Tanggal Kegiatan</th>
								            <th>Attachment</th>
								            <th>Action</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs as $t)
								        <tr>
								            <td><a href="{{ route('tabung.show',$t->id) }}">{{ $t->no_tabung or '' }}</a></td>
								            <td>{{ $ti->itemujiriksa or '' }}</td>
								            <td>{{ $ti->itemujiriksa->nama_barang or '' }}</td>
								            <td><a href="#">File</a></td>
								            <td>
								            	<form method="POST" action="{{ route('tabung.destroy', $t->id) }}" accept-charset="UTF-8">
						                            <input name="_method" type="hidden" value="DELETE">
						                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
						                            <a href="{{ route('tabung.edit',$t->id) }}" class="btn btn-xs btn-primary">Edit</a>
				                        			<input type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete">
				                        		</form>
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
				    "targets": [ 5 ],
				    "searchable": false,
				    "orderable": false
			    } ]
		} );

		
			} );
	</script>
@endsection