@extends('layouts.app')
@section('title', 'Manajemen User | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">User</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">User</h2>
					</div>
					<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('user.create') }}">Tambah Pengguna</a> </p>
						<table id="table_id" class="display">
						    <thead>
						        <tr>
						            <th>Nama</th>
						            <th>Email</th>
						            <th>Role</th>
						            <th>Tanggal Dibuat</th>
						            <th class="action">Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach($users as $u)
						        <tr>
						            <td><a href="#">{{ $u->name }}</a></td>
						            <td>{{ $u->email }}</td>
						            <td>{{ $u->roles->first()->display_name }}</td>
						            <td>{{ $u->created_at->format('d-M-Y') }}</td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											    Aksi <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  	<li>
													<a type="button" href="{{ route('user.edit', $u->id)}}">Edit</a>
											  	</li>
											  	<li>
													<a type="button" href="{{ route('user.destroy', $u->id)}}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Delete</a>
											  	</li>
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
	    $('#table_id').dataTable( {
	    "aaSorting": [],
	  	"columnDefs": [ {
		    "targets": [ 4 ],
		    "searchable": false,
		    "orderable": false
	    },
	    {
			"type": "date-dd-mmm-yyyy", targets :[3]
		}  ]
} );
	} );
</script>
@endsection
