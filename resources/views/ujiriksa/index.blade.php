@extends('layouts.app')
@section('title', 'Ujiriksa | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li class="active">Layanan</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Layanan</h2>
					</div>
					<div class="panel-body">
						<p class="btn-group"> 
							<a class="btn btn-info" href="{{ route('ujiriksa.create') }}">Registrasi Uji</a> 
						</p>
						<p class="btn-group pull-right"> 
							<a class="btn btn-warning" href="{{ route('ujiriksa.exportExcel') }}">Export Data Layanan</a> 
						</p>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#table_service" aria-controls="table_service" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Service
								</a>
							</li>
							<li role="presentation">
								<a href="#table_hydro" aria-controls="table_hydro" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Hydrostatic
								</a>
							</li>
							<li role="presentation">
								<a href="#table_visual" aria-controls="table_visual" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Visualstatic
								</a>
							</li>							
						</ul>
						<div class="tab-content">
						<div class="tab-pane active" role="tabpanel" id="table_service">
							<table id="service" class="display">
							    <thead>
							        <tr>
							        	<th>No Registrasi Uji</th>
							            <th>Jenis Uji</th>
							            <th>Progress</th>
							            <th>Keterangan</th>
							            <th>Tanggal Masuk</th>
							            <th>Tanggal Selesai</th>
							            <th>Nama Pemilik</th>
							            <th>Aksi</th>
							        </tr>
							    </thead>
							    <tbody>
							    @foreach($service as $fu)
							        <tr>
							        	<td><a href="{{ route('ujiriksa.show', $fu->id) }}">{{ $fu->no_registrasi }}</a></td>
							            <td>{{ $fu->jenis_uji }}</td>
							        	<td>{{ $fu->progress }}</td>
							        	<td>{{ $fu->keterangan }}</td>
							            <td>{{ $fu->created_at->format('d-M-Y') }}</td>
							            @if(isset($fu->done_at))
							            <td>{{ $fu->done_at->format('d-M-Y') }}</td>
							            @else
							            <td>{{ "Belum Diinput" }}</td>
							            @endif
							            <td><a href="{{ route('customer.show', $fu->customer->id) }}">{{ $fu->customer->nama }}</a></td>
							            <td>
							            	<div class="btn-group dropdown" role="group" aria-label="...">
											  <div class="btn-group navbar-right">
												  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												    Aksi <span class="caret"></span>
												  </button>
												  <ul class="dropdown-menu ">
												  <li class="dropdown-header">Aksi</li>
												  @if($fu->progress == 'Selesai')@if(!isset($fu->itemujiriksa->first()->serviceresult))
												  	<li>
														<a type="button" href="{{ route('service.create', $fu->id) }}">Input Hasil Service</a>
												  	</li>
												  @endif
												  @endif
												  	<!-- <li>
														<a type="button" href="{{ route('ujiriksa.edit', $fu->id) }}">Edit</a>
												  	</li> -->
												  	<li>
														<a type="button" name="uji" href="{{ route('billing.createUji', $fu->id)}}">Buat Invoice</a>
												  	</li>
												  	<li>
														<a type="button" href="{{ route('ujiriksa.destroy', $fu->id)}}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Delete</a>
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
												    <li><a href="{{ route('ujiriksa.exportPdf', $fu->id) }}" target="_blank">Export PDF</a></li>
												    <!-- <li><a href="#">Kirim Email</a></li> -->
												    
												  </ul>
												</div>
											</div>
							            </td>
							        </tr>
							    @endforeach
							    </tbody>
							</table>
						</div>
							<div class="tab-pane" role="tabpanel" id="table_hydro">
								<table id="hydro" class="display">
								    <thead>
								        <tr>
								        	<th>No Registrasi Uji</th>
								            <th>Jenis Layanan</th>
								            <th>Progress</th>
								            <th>Keterangan</th>
								            <th>Tanggal Masuk</th>
								            <th>Tanggal Selesai</th>
								            <th>Nama Pemilik</th>
								            <th>Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach($hydro as $fu)
								        <tr>
								        	<td><a href="{{ route('ujiriksa.show', $fu->id) }}">{{ $fu->no_registrasi }}</a></td>
								            <td>{{ $fu->jenis_uji }}</td>
								        	<td>{{ $fu->progress }}</td>
								        	<td>{{ $fu->keterangan }}</td>
								            <td>{{ $fu->created_at->format('d-M-Y') }}</td>
								            @if(isset($fu->done_at))
								            <td>{{ $fu->done_at->format('d-M-Y') }}</td>
								            @else
								            <td>{{ "Belum Diinput" }}</td>
								            @endif
								            <td><a href="{{ route('customer.show', $fu->customer->id) }}">{{ $fu->customer->nama }}</a></td>
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Aksi <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  <li class="dropdown-header">Aksi</li>

													  @if($fu->progress == 'Selesai')
													  @if(!isset($fu->itemujiriksa->first()->hydrostaticresult))
													  	<li>
															<a type="button" href="{{ route('hydrostatic.create', $fu->id) }}">Input Hasil Hydrostatic</a>
													  	</li>
													  @endif
													  @endif
														  	<!-- <li>
																<a type="button" href="{{ route('ujiriksa.edit', $fu->id) }}">Edit</a>
														  	</li> -->
													  	<li>
															<a type="button" href="{{ route('ujiriksa.destroy', $fu->id)}}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Delete</a>
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
													    <li><a href="{{ route('ujiriksa.exportPdf', $fu->id) }}" target="_blank">Export PDF</a></li>
													    <!-- <li><a href="#">Kirim Email</a></li> -->
													    
													  </ul>
													</div>
												</div>
								            </td>
								        </tr>
								    @endforeach
								    </tbody>
								</table>
							</div>
							<div class="tab-pane" role="tabpanel" id="table_visual">
								<table id="visual" class="display">
								    <thead>
								        <tr>
								        	<th>No Registrasi Uji</th>
								            <th>Jenis Uji</th>
								            <th>Progress</th>
								            <th>Keterangan</th>
								            <th>Tanggal Masuk</th>
								            <th>Tanggal Selesai</th>
								            <th>Nama Pemilik</th>
								            <th>Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach($visual as $fu)
								        <tr>
								        	<td><a href="{{ route('ujiriksa.show', $fu->id) }}">{{ $fu->no_registrasi }}</a></td>
								            <td>{{ $fu->jenis_uji }}</td>
								        	<td>{{ $fu->progress }}</td>
								        	<td>{{ $fu->keterangan }}</td>
								            <td>{{ $fu->created_at->format('d-M-Y') }}</td>
								            @if(isset($fu->done_at))
								            <td>{{ $fu->done_at->format('d-M-Y') }}</td>
								            @else
								            <td>{{ "Belum Diinput" }}</td>
								            @endif
								            <td><a href="{{ route('customer.show', $fu->customer->id) }}">{{ $fu->customer->nama }}</a></td>
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Aksi <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  <li class="dropdown-header">Aksi</li>
													  @if($fu->progress == 'Selesai')
													  @if(!isset($fu->itemujiriksa->first()->visualresult))
													  	<li>
															<a type="button" href="{{ route('visualstatic.create', $fu->id) }}">Input Hasil Visual</a>
													  	</li>
													  @endif
													  @endif
													  	<!-- <li>
															<a type="button" href="{{ route('ujiriksa.edit', $fu->id) }}">Edit</a>
													  	</li> -->
													  	<li>
															<a type="button" href="{{ route('ujiriksa.destroy', $fu->id)}}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Delete</a>
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
													    <li><a href="{{ route('ujiriksa.exportPdf', $fu->id) }}" target="_blank">Export PDF</a></li>
													    <!-- <li><a href="#">Kirim Email</a></li> -->
													    
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
@endsection

@section('scripts')
<script>
	$(document).ready( function () {
	    $('.display').DataTable({
	    "aaSorting": [],
	  	"columnDefs": [ {
		    "targets": [ 7 ],
		    "searchable": false,
		    "orderable": false
	    },
	    {
			"type": "date-dd-mmm-yyyy", targets :[4]
		}  ]
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
<!-- <script>
	$(function() {
		$('\
			<div id="filter_status" class ="dataTables_length" style="display: inline-block; margin-left:30px;">\
				<label>Tanggal Awal \
				<input type="date" id="min" name="min">\
				</label>\
				<label>Tanggal Akhir \
				<input type="date" id="max" name="max">\
				</label>\
			</div>\
			').insertAfter('.dataTables_length');
	});


/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = $('#min').val() ;
        // console.log($(min));
        
        var max = parseInt( $('#max').val() );
        var date = parseFloat( data[3] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && date <= max ) ||
             ( min <= date   && isNaN( max ) ) ||
             ( min <= date   && date <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#table_id').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
</script> -->
@endsection
