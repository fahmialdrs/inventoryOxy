@extends('layouts.app')

@section('title', 'Detail Hasil Visualstatic |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/') }}"> Beranda</a></li>
                	<li><a href="#"> Ujiriksa</a></li>
					<li class="active">Detail Hasil Visualstatic {{ $visual->itemujiriksa->formujiriksa->no_registrasi }}</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Hasil Visual </h2>
					</div>
					<div class="panel-body">
						<br><br><br>
						<div class="col-md-8">
						<table class="table table-responsive">
							<tr>
								<td class="text-muted">Tanggal Visual</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->formujiriksa->progress_at }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Registrasi Uji</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->formujiriksa->no_registrasi }}</td>
							</tr>
							<tr>
								<td class="text-muted">Nama Pemilik</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->formujiriksa->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Tabung</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->tube->no_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Jumlah Barang</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->jumlah_barang }}</td>
							</tr>							
							<tr>
								<td class="text-muted">Nama Barang</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->nama_barang }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keluhan</td>
								<td>:</td>
								<td>{{ $visual->itemujiriksa->keluhan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keterangan Visual</td>
								<td>:</td>
								<td>{{ $visual->keterangan_visual }}</td>
							</tr>
							<tr>								
								<td class="text-muted">Foto Hasil Visual</td>
								<td>:</td>
								<td>
									@foreach ($visual->fotovisual as $foto)
										{{ $foto->foto_tabung_visual }} <br>
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
