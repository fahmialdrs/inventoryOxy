@extends('layouts.app')
@section('title', 'Customer | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Customer</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Customer</h2>
					</div>
					<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('customer.create') }}">Create</a> </p>
						<table id="table_id" class="display">
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
						            	<form method="POST" action="{{ route('customer.destroy', $c->id) }}" accept-charset="UTF-8">
				                            <input name="_method" type="hidden" value="DELETE">
				                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
				                            <a href="{{ route('customer.edit',$c->id) }}" class="btn btn-xs btn-primary">Edit</a>
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
			    } ]
} );
	} );
</script>
@endsection
