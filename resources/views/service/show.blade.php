@extends('layouts.app')

@section('title', 'Detail Hasil Service |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/ujiriksa') }}"> Layanan</a></li>
					<li><a href="{{ url('/admin/ujiriksa/show', $service->itemujiriksa->formujiriksa->id) }}"> Detail Ujiriksa</a></li>
					<li class="active">Detail Hasil Service {{ $service->itemujiriksa->formujiriksa->no_registrasi }}</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Hasil Service </h2>
					</div>
					<div class="panel-body">					
						<a href="{{ route('service.edit', $service->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md-8">
						<table class="table table-responsive">
							<tr>
								<td class="text-muted">Tanggal Service</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->formujiriksa->progress_at->format('d-M-Y') }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Registrasi Uji</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->formujiriksa->no_registrasi }}</td>
							</tr>
							<tr>
								<td class="text-muted">Nama Pemilik</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->formujiriksa->customer->nama }}</td>
							</tr>
							@if(isset($service->itemujiriksa->tube_id))
							<tr>
								<td class="text-muted">No Tabung</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->tube->no_tabung }}</td>
							</tr>
							@else
							<tr>
								<td class="text-muted">No Alat</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->alat->no_alat }}</td>
							</tr>
							@endif
							<tr>
								<td class="text-muted">Jumlah Barang</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->jumlah_barang }}</td>
							</tr>							
							<tr>
								<td class="text-muted">Nama Barang</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->nama_barang }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keluhan</td>
								<td>:</td>
								<td>{{ $service->itemujiriksa->keluhan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keterangan Service</td>
								<td>:</td>
								<td>{{ $service->keterangan_service }}</td>
							</tr>
							<tr>								
								<td class="text-muted">Foto Hasil Service</td>
								<td>:</td>
								<td>
									@foreach ($service->fotoservice as $foto)
										<img src="{{ asset('storage/foto/'.$foto->foto_tabung_service) }}" class="img-rounded" width="100" height="75">
									@endforeach
								</td>
							</tr>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
