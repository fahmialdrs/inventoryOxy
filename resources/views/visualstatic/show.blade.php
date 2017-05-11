@extends('layouts.app')

@section('title', 'Detail Hasil Visualstatic |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/ujiriksa') }}"> Ujiriksa</a></li>
					<li><a href="{{ url('/admin/ujiriksa/{ujiriksa}') }}"> Detail Form Ujiriksa</a></li>
					<li class="active">Detail Hasil Visualstatic  </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Hasil Visualstatic </h2>
					</div>
					<div class="panel-body">					
						<a href="{{ route('visualstatic.edit', $visuals->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md 2">
						<table class="table table-responsive">
							<tr>
								<td class="text-muted">Tanggal Service</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">No Registrasi Uji</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Nama Pemilik</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">No Tabung</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Jumlah Barang</td>
								<td>{{ $visuals->itemujiriksa->jumlah_barang }}</td>
							</tr>							
							<tr>
								<td class="text-muted">Nama Barang</td>
								<td>{{ $visuals->itemujiriksa->nama_barang }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keluhan</td>
								<td>{{ $visuals->itemujiriksa->keluhan }}</td>
							</tr>
							<tr>								
								<td class="text-muted">Foto Hasil Visual</td>
								@foreach ($form as $foto)
									<td>{{ $foto->foto_tabung_visual }}</td>
								@endforeach
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
