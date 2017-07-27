@extends('layouts.app')
@section('title', 'Service | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li class="active">Service</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Service</h2>
					</div>
					<div class="panel-body">
					<p class="btn-group"> 
						<a class="btn btn-default" href="{{ route('service.create') }}">Registrasi Service</a>
					</p>
					<p class="btn-group pull-right"> 
						<a class="btn btn-primary" href="{{ route('service.createHasil') }}">Input Hasil Service</a> 
					</p>
						<table id="table_id" class="display">
						    <thead>
						        <tr>
						        	<th>No Registrasi Service</th>
						            <th>Nama Pemilik</th>
						            <th>No Tabung</th>
						            <th>Keluhan</th>
						            <th>Progress</th>
						            <th>Tanggal Masuk</th>
						            <th>Tanggal Selesai</th>						            
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach ($services as $s)
						        <tr>
						            <td>{{ $s->no_registrasi }}</td>
						            <td><a href="#">{{ $s->tube->customer->nama }}</a></td>
						            <td><a href="#">{{ $s->tube->no_tabung }}</a></td>
						            <td>{{ $s->keluhan }}</td>
						            <td>{{ $s->progress }}</td>
						            <td>{{ $s->created_at }}</td>
						            <td>{{ $s->done_at }}</td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    Action <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  	<li>
													<a type="button" href="{{ route('service.createHasil') }}">Input Hasil Service</a>
											  	</li>
											  	<li>
													<a type="button" href=" {{ route('service.edit', $s->id) }}">Edit</a>
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
@endsection

@section('scripts')
<script>
	$(document).ready( function () {
	    $('#table_id').DataTable({
	  	"columnDefs": [ {
		    "targets": [ 7 ],
		    "searchable": false,
		    "orderable": false
	    } ]
});
	} );
</script>
@endsection
