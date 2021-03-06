@extends('layouts.app')
@section('title', 'Billing | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li class="active">Billing</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Billing</h2>
					</div>
					<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('billing.create') }}">Buat Invoice</a> </p>
						<table id="billing" class="display">
						    <thead>
						        <tr>
						            <th>No Invoice</th>
						            <th>Nama Customer</th>
						            <th>Email Customer</th>
						            <th>Perihal</th>
						            <th>Tanggal Cetak</th>
						            <th>Status</th>
						            <th class="action">Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach ($billings as $b)
						        <tr>
						            <td><a href="{{ route('billing.show', $b->id) }}">{{ $b->no_invoice }}</a></td>
						            <td>{{ $b->customer->nama }}</td>
						            <td>{{ $b->customer->email }}</td>
						            <td>{{ $b->perihal }}</td>
						            <td>{{ $b->created_at->format('d-M-Y') }}</td>
						            <td>{{ $b->status }}</td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    Aksi <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  	@if($b->status != "Sudah Bayar")
											  	<li>
													<a type="button" href="{{ route('billing.edit', $b->id) }}">Edit</a>
											  	</li>
												@endif
											  	<li>
													<a type="button" href="{{ route('billing.destroy', ['id' => $b->id]) }}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')">Delete</a>
											  	</li>
											  	<li role="separator" class="divider"></li>
											  	@if($b->status != "Sudah Bayar")
											    <li><a href="{{ route('billing.changeStatus', $b->id) }}">Ubah Status Dibayar</a></li>
											    @endif

											    <li><a href="{{ route('billing.exportPdf', ['id' => $b->id]) }}" target="_blank">Export PDF</a></li>
											    <!-- <li><a href="{{ route('billing.kirimEmail', $b->id) }}">Kirim Email</a></li> -->
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
	    $('#billing').dataTable( {
	    "aaSorting": [],
	  		"columnDefs": [ {
			    "targets": [ 6 ],
			    "searchable": false,
			    "orderable": false
	    	},
		    {
    			"type": "date-dd-mmm-yyyy", targets :[4]
    		}  ]
} );
	} );
</script>
@endsection
