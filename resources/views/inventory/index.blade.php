@extends('layouts.app')
@section('title', 'Data Inventory | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Data Inventory</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Customer</h2>
					</div>
					<div class="panel-body">
					<p> 
						<a class="btn btn-primary" href="{{ route('customer.create') }}">Tambah Customer</a> 
						<a class="btn btn-primary" href="{{ route('tabung.create') }}">Tambah Tabung</a>
					</p>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#table_customer" aria-controls="customer" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Customer
								</a>
							</li>
							<li role="presentation">
								<a href="#table_tabung" aria-controls="tabung" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> Data Tabung
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="table_customer">
								<table id="customer" class="display">
						    <thead>
						        <tr>
						            <th>Name</th>
						            <th>Email</th>
						            <th>No Telp</th>
						            <th>Tanggal Member</th>
						            <th class="action">Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach ($customers as $c)
						        <tr>
						            <td><a href="{{ route('customer.show',$c->id) }}">{{ $c->nama }}</a></td>
						            <td>{{ $c->email }}</td>
						            <td>{{ $c->no_telp }}</td>
						            <td>{{ $c->tanggal_member }}</td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											    Action <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  	<li>
													<a type="button" href="{{ route('customer.edit',$c->id) }}">Edit</a>
											  	</li>
											  	<!-- <li>
											  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
											  	</li> -->
											  	<li>
													<form method="POST" action="{{ route('customer.destroy', $c->id) }}" accept-charset="UTF-8">
						                            <input name="_method" type="hidden" value="delete">
						                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
				                        			<input type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete">
				                        		</form>													
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
							<div class="tab-pane" role="tabpanel" id="table_tabung">
								<table id="tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Kode</th>
								            <th>Kapasitas Isi Tabung</th>
								            <th>Tanggal Pemadatan Terakhir</th>
								            <th>Tanggal Visual Terakhir</th>
								            <th>Nama Pemilik</th>
								            <th searchable=false, orderable=false>Action</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs as $t)
								        <tr>
								            <td><a href="{{ route('tabung.show',$t->id) }}">{{ $t->no_tabung }}</a></td>
								            <td>{{ $t->kode_tabung }}</td>
								            <td>{{ $t->isi_tabung }}</td>
								            <td>{{ $t->formujiriksa->done_at or '' }}</td>
								            <td>{{ $t->updated_at }}</td>
								            <td><a href="{{ route('customer.show',['id'=>$t->id]) }}">{{ $t->customer->nama }}</a></td>
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
	    $('#customer').dataTable( {
	  	"columnDefs": [ {
		    "targets": [ 4 ],
		    "searchable": false,
		    "orderable": false
	    	} ]
		} );

		$('#tabung').dataTable( {
	  	"columnDefs": [ {
		    "targets": [ 5 ],
		    "searchable": false,
		    "orderable": false
	    	} ]
		} );
	} );
</script>
@endsection
