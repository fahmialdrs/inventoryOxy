@extends('layouts.app')
@section('title', 'Data Peralatan | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/jenisalat') }}">Data Peralatan</a></li>
					<li class="active">Edit Data Merk Alat</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Data Peralatan</h2>
					</div>
					<div class="panel-body">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#table_merk" aria-controls="table_merk" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> Data Merk Alat
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="table_merk">
								<div class="col-md-6">
									{!! Form::model($merkalats, ['url'=>route('merk.update', $merkalats->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}
										@include('peralatan.merkalat._form')
									{!! Form::close() !!}
								</div>
								<div class="col-md-6">
									<table class="table table-responsive display">
									    <thead>
									        <tr>
									            <th>Nama Merk</th>
									            <th>Keterangan</th>
									            <th>Aksi</th>
									        </tr>
									    </thead>
									    <tbody>
									    @foreach ($merkalat as $m)
									        <tr>
									            <td>{{ $m->nama_merk }}</td>
									            <td>{{ $m->keterangan }}</td>
									            <td>
									            	<div class="btn-group dropdown" role="group" aria-label="...">
													  <div class="btn-group navbar-right">
														  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														    Aksi <span class="caret"></span>
														  </button>
														  <ul class="dropdown-menu ">
														  	<li>
																<a type="button" href="{{ route('merk.edit', $m->id) }}">Edit</a>
														  	</li>
														  	<!-- <li>
														  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
														  	</li> -->
														  	<li>
														  		<a type="button" href="{{ route('merk.destroy', $m->id) }}">Hapus</a>
														  	</li>
														  	<li role="separator" class="divider"></li>
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
	    "aaSorting": [],
	  		"columnDefs": [ {
			    "targets": [ 2 ],
			    "searchable": false,
			    "orderable": false
	    	}]
} );
	} );
</script>
@endsection