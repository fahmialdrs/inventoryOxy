@extends('layouts.app')
@section('title', 'Data Inventory | ')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li class="active">Data Inventory</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Customer</h2>
					</div>
					<div class="panel-body">
					<p> 
						<a class="btn btn-primary" href="{{ route('customer.create') }}">Tambah Customer</a> 
						<a class="btn btn-primary" href="{{ route('tabung.create') }}">Tambah Tabung</a>
						<a class="btn btn-primary" href="{{ route('alat.create') }}">Tambah Peralatan</a>
					</p>
					<p class="pull-right"> 
						<a class="btn btn-warning" href="{{ route('customer.exportExcel') }}">Export Data Customer</a> 
						<a class="btn btn-warning" href="{{ route('tabung.exportExcel') }}">Export Data Tabung</a>
						<a class="btn btn-warning" href="{{ route('alat.exportExcel') }}">Export Data Alat</a>
					</p>
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#table_customer" aria-controls="table_customer" role="tab" data-toggle="tab">
									<i class="fa fa-pencil-square-o"></i> Data Customer
								</a>
							</li>
							<li role="presentation">
								<a href="#table_tabung" aria-controls="tabung" role="tab" data-toggle="tab">
									<i class="fa fa-cloud-upload"></i> Data Tabung
								</a>
							</li>
							<li role="presentation">
								<a href="#table_alat" aria-controls="alat" role="tab" data-toggle="tab">
									<i class="fa fa-wrench"></i> Data Peralatan
								</a>
							</li>						
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="table_customer">
								<table id="customer" class="display">
						    <thead>
						        <tr>
						            <th>Name</th>
						            <th>Email</th>
						            <th>No Telp</th>
						            <th>Tanggal Member</th>
						            <th class="action">Aksi</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach ($customers as $c)
						        <tr>
						            <td><a href="{{ route('customer.show',$c->id) }}">{{ $c->nama }}</a></td>
						            <td>{{ $c->email }}</td>
						            <td>{{ $c->no_telp }}</td>
						            <td>{{ date("d-M-Y", strtotime($c->tanggal_member)) }}</td>
						            <td>
						            	<div class="btn-group dropdown" role="group" aria-label="...">
										  <div class="btn-group navbar-right">
											  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											    Aksi <span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu ">
											  	<li>
													<a type="button" href="{{ route('customer.edit',$c->id) }}">Edit</a>
											  	</li>
											  	<!-- <li>
											  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
											  	</li> -->
											  	<li>
											  		<a type="button" href="{{ route('customer.destroy', $c->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>												
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
							<div class="tab-pane" role="tabpanel" id="table_tabung">
								<table id="tabung" class="display">
								    <thead>
								        <tr>
								            <th>No Tabung</th>
								            <th>Kode</th>
								            <th>Kapasitas Isi Tabung</th>
								            <th>Tanggal Pemadatan Terakhir</th>
								            <th>Tanggal Pemadatan Selanjutnya</th>
								            <th>Tanggal Visual Terakhir</th>
								            <th>Tanggal Visual Selanjutnya</th>
								            <th>Nama Pemilik</th>
								            <th searchable=false, orderable=false>Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($tabungs as $t)
								        <tr>
								            <td><a href="{{ route('tabung.show',$t->id) }}">{{ $t->no_tabung }}</a></td>
								            <td>{{ $t->kode_tabung }}</td>
								            <td>{{ $t->isi_tabung }}</td>
								            <td>{{ $t->terakhir_hydrostatic->format('d-M-Y') }}</td>
								            <td>{{ $t->terakhir_hydrostatic->addYears(5)->format('d-M-Y') }}</td>
								            <td>{{ $t->terakhir_visualstatic->format('d-M-Y') }}</td>
								            <td>{{ $t->terakhir_visualstatic->addYears(1)->format('d-M-Y') }}</td>
								            <td><a href="{{ route('customer.show',['id'=>$t->id]) }}">{{ $t->customer->nama }}</a></td>
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													    Aksi <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="{{ route('tabung.edit', $t->id) }}">Edit</a>
													  	</li>
													  	<!-- <li>
													  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
													  	</li> -->
													  	<li>
													  		<a type="button" href="{{ route('tabung.destroy', $t->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>
													  	</li>
													  	<li role="separator" class="divider"></li>
													    <li><a href="{{ route('tabung.barcode', $t->id) }}" target="_blank">Unduh Barcode</a></li>
													  </ul>
													</div>
												</div>
								            </td>
								        </tr>
								    @endforeach
								    </tbody>
								</table>
							</div>

							<div class="tab-pane" role="tabpanel" id="table_alat">
								<table id="alat" class="display">
								    <thead>
								        <tr>
								            <th>No Alat</th>
								            <th>Jenis Alat</th>
								            <th>Merk</th>
								            <th>Tipe</th>
								            <th>Nama Pemilik</th>
								            <th searchable=false, orderable=false>Aksi</th>
								        </tr>
								    </thead>
								    <tbody>
								    @foreach ($alats as $a)
								        <tr>
								            <td><a href="{{ route('alat.show',$a->id) }}">{{ $a->no_alat }}</a></td>
								            <td>{{ $a->jenisalat->nama_alat }}</td>
								            <td>{{ $a->merk->nama_merk }}</td>
								            <td>{{ $a->tipe->nama_tipe }}</td>
								            <td><a href="{{ route('customer.show',['id'=>$a->id]) }}">{{ $a->customer->nama }}</a></td>
								            <td>
								            	<div class="btn-group dropdown" role="group" aria-label="...">
												  <div class="btn-group navbar-right">
													  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													    Aksi <span class="caret"></span>
													  </button>
													  <ul class="dropdown-menu ">
													  	<li>
															<a type="button" href="{{ route('alat.edit', $a->id) }}">Edit</a>
													  	</li>
													  	<!-- <li>
													  		<a type="submit" href="" onclick="return confirm('Anda yakin akan menghapus data ?');" value="Delete"> Delete</a>
													  	</li> -->
													  	<li>
													  		<a type="button" href="{{ route('alat.destroy', $a->id) }}" onclick="return confirm('Apakah Anda Ingin Menghapus Data?')">Hapus</a>
													  	</li>
													  	<li role="separator" class="divider"></li>
													    <li><a href="{{ route('alat.barcode', $a->id) }}" target="_blank">Unduh Barcode</a></li>
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
	    $('#customer').dataTable( {
	    	"aaSorting": [],
	  	"columnDefs": [ {
		    "targets": [ 4 ],
		    "searchable": false,
		    "orderable": false
	    	} ]
		} );

		$('#tabung').dataTable( {
			"aaSorting": [],
	  	"columnDefs": [ {
		    "targets": [ 8 ],
		    "searchable": false,
		    "orderable": false
	    	},
	    {
	    	"type": "date-dd-mmm-yyyy", targets :[3, 4, 5, 6]
	    } ]
		} );

		$('#alat').dataTable( {
			"aaSorting": [],
	  	"columnDefs": [ {
		    "targets": [ 5 ],
		    "searchable": false,
		    "orderable": false
	    	} ]
		} );
	} );
</script>
@endsection
