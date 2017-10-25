@extends('layouts.app')
@section('title', 'Data Peralatan | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li class="active">Data Peralatan</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Data Peralatan</h2>
					</div>
					<div class="panel-body">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#table_jenisalat" aria-controls="table_jenisalat" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Jenis Alat
								</a>
							</li>
							<li role="presentation">
								<a href="#table_merk" aria-controls="table_merk" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Merk Alat
								</a>
							</li>
							<li role="presentation">
								<a href="#table_tipe" aria-controls="table_tipe" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Tipe Alat
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="table_jenisalat">
								<div class="col-md-6">
									@include('peralatan.jenisalat.create')
								</div>
								<div class="col-md-6">
									<table class="table table-responsive jenisalat">
									    <thead>
									        <tr>
									            <th>Nama Jenis Alat</th>
									            <th>Singkatan Jenis Alat</th>
									            <th>Keterangan</th>
									            <th>Reminder</th>
									            <th class="action">Aksi</th>
									        </tr>
									    </thead>
									    <tbody>
									    @foreach ($jenisalat as $j)
									        <tr>
									            <td>{{ $j->nama_alat }}</td>
									            <td>{{ $j->slugjenis }}</td>
									            <td>{{ $j->keterangan}}</td>
									            <td>{{ $j->reminder }}</td>
									            <td>
									            	<div class="btn-group dropdown" role="group" aria-label="...">
													  <div class="btn-group navbar-right">
														  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														    Aksi <span class="caret"></span>
														  </button>
														  <ul class="dropdown-menu ">
														  	<li>
																<a type="button" href="{{ route('jenisalat.edit',$j->id) }}">Edit</a>
														  	</li>
														  	<!-- <li>
														  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
														  	</li> -->
														  	<li>
														  		<a type="button" href="{{ route('jenisalat.destroy', $j->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>												
														  	</li>
														  	<li role="separator" class="divider"></li>
														    <!-- <li><a href="#">Unduh Label</a></li> -->
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
							<div class="tab-pane" role="tabpanel" id="table_merk">
								<div class="col-md-6">
									@include('peralatan.merkalat.create')
								</div>
								<div class="col-md-6">
									<table class="table table-responsive display">
									    <thead>
									        <tr>
									            <th>Nama Merk</th>
									            <th>Singkatan Merk Alat</th>
									            <th>Keterangan</th>
									            <th>Aksi</th>
									        </tr>
									    </thead>
									    <tbody>
									    @foreach ($merkalat as $m)
									        <tr>
									            <td>{{ $m->nama_merk }}</td>
									            <td>{{ $m->slugmerk }}</td>
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
														  		<a type="button" href="{{ route('merk.destroy', $m->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>
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
							<div class="tab-pane" role="tabpanel" id="table_tipe">
								<div class="col-md-6">
									@include('peralatan.tipealat.create')
								</div>
								<div class="col-md-6">
									<table class="table table-responsive display">
									    <thead>
									        <tr>
									            <th>Nama Tipe</th>
									            <th>Singkatan Tipe Alat</th>
									            <th>Keterangan</th>
									            <th>Aksi</th>
									        </tr>
									    </thead>
									    <tbody>
									    @foreach ($tipealat as $t)
									        <tr>
									            <td>{{ $t->nama_tipe }}</td>
									            <td>{{ $t->slugtipe }}</td>
									            <td>{{ $t->keterangan }}</td>
									            <td>
									            	<div class="btn-group dropdown" role="group" aria-label="...">
													  <div class="btn-group navbar-right">
														  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														    Aksi <span class="caret"></span>
														  </button>
														  <ul class="dropdown-menu ">
														  	<li>
																<a type="button" href="{{ route('tipe.edit', $t->id) }}">Edit</a>
														  	</li>
														  	<!-- <li>
														  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
														  	</li> -->
														  	<li>
														  		<a type="button" href="{{ route('tipe.destroy', $t->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>
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
	    $('.jenisalat').dataTable( {
	    "aaSorting": [],
	  		"columnDefs": [ {
			    "targets": [ 3 ],
			    "searchable": false,
			    "orderable": false
	    	}]
} );

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