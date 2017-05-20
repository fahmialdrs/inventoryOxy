@extends('layouts.app')
@section('title', 'Ujiriksa | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Ujiriksa</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Ujiriksa</h2>
					</div>
					<div class="panel-body">
					<p class="btn-group"> 
						<a class="btn btn-info" href="{{ route('ujiriksa.create') }}">Registrasi Uji</a> 
					</p>
					<p class="btn-group pull-right"> 
						<a class="btn btn-primary" href="{{ route('hydrostatic.createImport') }}">Import Hasil Hydrostatic</a>
					</p>
						<table id="table_id" class="display">
						    <thead>
						        <tr>
						        	<th>No Registrasi Uji</th>
						            <th>Jenis Uji</th>
						            <th>Progress</th>
						            <th>Tanggal Masuk</th>
						            <th>Tanggal Selesai</th>
						            <th>Nama Pemilik</th>
						            <th>Action</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach($formujiriksas as $fu)
						        <tr>
						        	<td><a href="{{ route('ujiriksa.show', $fu->id) }}">{{ $fu->no_registrasi }}</a></td>
						            <td>{{ $fu->jenis_uji }}</td>
						        	<td>{{ $fu->progress }}</td>
						            <td>{{ $fu->created_at }}</td>
						            <td>{{ $fu->done_at or 'Belum Selesai' }}</td>
						            <td><a href="#">{{ $fu->customer->nama }}</a></td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    Action <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  <li class="dropdown-header">Aksi</li>
											  @if($fu->jenis_uji == 'Hydrostatic')
											  	<li>
													<a type="button" href="{{ route('hydrostatic.create', $fu->id) }}">Input Hasil Hydrostatic</a>
											  	</li>
											  @endif
											  @if($fu->jenis_uji == 'Visualstatic')
											  	<li>
													<a type="button" href="{{ route('visualstatic.create', $fu->id) }}">Input Hasil Visual</a>
											  	</li>
											  @endif
											  @if($fu->jenis_uji == 'Service')
											  	<li>
													<a type="button" href="{{ route('service.create', $fu->id) }}">Input Hasil Service</a>
											  	</li>
											  @endif
											  	<li>
													<a type="button" href="{{ route('ujiriksa.edit', $fu->id) }}">Edit</a>
											  	</li>
											  	<li>
													<a type="button" href="{{ route('ujiriksa.destroy', $fu->id)}}">Delete</a>
											  	</li>											  	
											  	@if($fu->progress == 'Waiting List')
											  	<li role="separator" class="divider"></li>
											  	<li class="dropdown-header">Ubah Status Progress</li>
											    <li><a href="{{ route('ujiriksa.changeStatus', $fu->id) }}">Dikerjakan</a></li>
											    @elseif($fu->progress == 'Sedang Dikerjakan')
											    <li role="separator" class="divider"></li>
											  	<li class="dropdown-header">Ubah Status Progress</li>
											    <li><a href="{{ route('ujiriksa.changeStatus', $fu->id) }}">Selesai</a></li>
											    @elseif($fu->progress == 'Selesai')
											    @if(!isset($fu->nama_pengambil))
											    <li role="separator" class="divider"></li>
											  	<li class="dropdown-header">Input Nama Pengambil</li>
											    <li><a href="#" onclick="myFunction()">Diambil</a></li>
											    <form id="form" role="form" action="{{ route('ujiriksa.storePengambil', $fu->id)}}" method="post">
												{!! csrf_field() !!}
											    	<input type="hidden" id="pengambil" name="nama_pengambil" />
												</form>
												@endif
											    @else
											    @endif
											    <li role="separator" class="divider"></li>
											    <li class="dropdown-header">Aksi Tambahan</li>
											    <li><a href="#">Export PDF</a></li>
											    <li><a href="#">Kirim Email</a></li>
											    
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
		    "targets": [ 6 ],
		    "searchable": false,
		    "orderable": false
	    } ]
});
	} );
</script>
<script>
	function myFunction() {
    var txt;
    var person = prompt("Masukan Nama Pengambil:");
    if (person == null || person == "") {
        txt = "Nama Pengambil Tidak Boleh Kosong.";
        alert(txt);
    } else {
        document.getElementById('pengambil').value = person.toString();
    	document.getElementById('form').submit();
    }
	}
</script>
@endsection
