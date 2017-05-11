@extends('layouts.app')
@section('title', 'Tabung | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Tabung</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Tabung</h2>
					</div>
					<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('tabung.create') }}">Create</a> </p>
						<table id="table_id" class="display">
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
						            <td>{{ $t->formujiriksa->done_at->first() }}</td>
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
@endsection

@section('scripts')
<script>
	$(document).ready( function () {
	    $('#table_id').DataTable({
	  	"columnDefs": [ {
		    "targets": [ 5 ],
		    "searchable": false,
		    "orderable": false
	    } ]
});
	} );
</script>
@endsection
