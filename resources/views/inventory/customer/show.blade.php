@extends('layouts.app')

@section('title', 'Detail Customer |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/customer') }}"> Data Inventory</a></li>
					<li class="active">Detail Customer {{ $customers->nama }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Customer <b>{{ $customers->nama }}</b></h2>
					</div>
					<div class="panel-body">
						<a href="{{ route('customer.edit', $customers->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<table class="table">
							<tr>
								<td class="text-muted">Nama</td>
								<td>{{ $customers->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Email</td>
								<td>{{ $customers->email }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Telp</td>
								<td>{{ $customers->no_telp }}</td>
							</tr>
							<tr>
								<td class="text-muted">Alamat</td>
								<td>{{ $customers->alamat }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Member</td>
								<td>{{ date("d-m-Y", strtotime($customers->tanggal_member)) }}</td>
							</tr>
						</table>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#data_tabung" aria-controls="data_tabung" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Tabung
								</a>
							</li>
							<li role="presentation">
								<a href="#history" aria-controls="history" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> History
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="data_tabung">
								<table id="tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Kandungan Gas</th>
								            <th>Terakhir Hydrostatic</th>
								            <th>Terakhir Visualstatic</th>
								            <th>Status</th>
								            <th class="action">Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($customers->tube as $t)
								        <tr>
								            <td><a href="{{ route('tabung.show',$t->id) }}">{{ $t->no_tabung }}</a></td>
								            <td>{{ $t->gas_diisikan }}</td>
								            <td>{{ $t->terakhir_hydrostatic->format('d-m-Y') }}</td>
								            <td>{{ $t->terakhir_visualstatic->format('d-m-Y') }}</td>
								            <td>{{ $t->status }}</td>
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Action <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="{{ route('tabung.edit', $t->id) }}">Edit</a>
													  	</li>
													  	<li>
															<a type="button" href="{{ route('tabung.destroy', ['id' => $t->id]) }}">Delete</a>
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
							<div class="tab-pane" role="tabpanel" id="history">
								<table id="histori" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Jenis Kegiatan</th>
								            <th>Keluhan</th>
								            <th>Tanggal Kegiatan</th>
								            <th>Hasil</th>
								            <th>Action</th>
								        </tr>
								    </thead>
								    <tbody>								    
								    @foreach ($customers->tube as $tb)	
								    @foreach ($tb->itemujiriksa as $t)							    
								        <tr>								    
								            <td><a href="{{ route('tabung.show',$t->tube->id) }}">{{ $t->tube->no_tabung or '' }}</a></td>
								            <td>{{ $t->keluhan or '' }}</td>
								            <td>{{ $t->formujiriksa->jenis_uji or '' }}</td>
								            @if(isset($t->formujiriksa->done_at))
								            <td>{{ $t->formujiriksa->done_at->format('d-m-Y') }}</td>
								            @if($t->formujiriksa->jenis_uji == "Hydrostatic")
								            <td><a href="{{ route('hydrostatic.show', $t->hydrostaticresult->id) }}">Hasil</a></td>
								            @elseif($t->formujiriksa->jenis_uji == "Visualstatic")
								            <td><a href="{{ route('visualstatic.show', $t->visualresult->id) }}">Hasil</a></td>
								            @elseif($t->formujiriksa->jenis_uji == "Service")
											<td><a href="{{ route('service.show', $t->serviceresult->id) }}">Hasil</a></td>
											@endif
								            @else
								            <td>{{ "Belum Selesai" }}</td>
								            <td>Hasil Belum Ada</td>
								            @endif
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													    Action <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="#">Edit</a>
													  	</li>
													  	<li>
															<a type="button" href="#">Delete</a>
													  	</li>
													  	<li role="separator" class="divider"></li>
													  </ul>
													</div>
												</div>
								            </td>
								        </tr>
								        @endforeach
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
		    $('#tabung').dataTable( {
		    	"aaSorting": [],
			  	"columnDefs": [ {
				    "targets": [ 5 ],
				    "searchable": false,
				    "orderable": false
			    } ]
		} );

		    $('#histori').dataTable( {
		    	"order": [[ 3, "desc" ]],
			  	"columnDefs": [ {
				    "targets": [ 5 ],
				    "searchable": false,
				    "orderable": false
			    } ]
		} );
		
			} );
	</script>
@endsection