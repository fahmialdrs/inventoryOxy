@extends('layouts.app')

@section('title', 'Detail Hasil Hydrostatic |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/ujiriksa') }}"> Ujiriksa</a></li>
					<li class="active">Detail Hasil Hydrostatic  </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Hasil Hydrostatic</h2>
					</div>
					<div class="panel-body">					
						<a href="{{ route('hydrostatic.edit', $hydro->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md 2">
						<table class="table table-responsive">
							<tr>
								<td class="text-muted">Tanggal Pemadatan</td>
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
								<td>{{ $hydro->no_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Gas Yang Diisikan</td>
								<td></td>
							</tr>							
							<tr>
								<td class="text-muted">Kode Tabung</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Warna Tabung</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Tekanan Kerja</td>
								<td>{{ $hydro->tekanan_kerja }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tekanan Pemadatan</td>
								<td>{{ $hydro->tekanan_pemadatan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Nama Pabrik Pembuat Tabung</td>
								<td>{{ $hydro->pabrik_pembuat_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Nama Pabrik Pemakai Tabung</td>
								<td>{{ $hydro->pabrik_pemakai_tabung }}</td>
							</tr>
							<tr>
								<td class="text-muted">Berat Tabung Tercatat</td>
								<td>{{ $hydro->tercatat }}</td>
							</tr>
							<tr>
								<td class="text-muted">Berat Tabung Sekarang</td>
								<td>{{ $hydro->berat_sekarang }}</td>
							</tr>
							<tr>
								<td class="text-muted">Selisih - </td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Selisih + </td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Selisih % </td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Isi Tabung</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Air Yang Dipadatkan</td>
								<td>{{ $hydro->air_dipadatkan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Pemuaian Cm3</td>
								<td>{{ $hydro->pemuaian_tetap_cm3 }}</td>
							</tr>
							<tr>
								<td class="text-muted">Pemuaian %</td>
								<td></td>
							</tr>
							<tr>
								<td class="text-muted">Suara Pukulan</td>
								<td>{{ $hydro->suara_pukulan }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keadaan Karat</td>
								<td>{{ $hydro->keadaan_karat }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keadaan Luar</td>
								<td>{{ $hydro->keadaan_luar }}</td>
							</tr>
							<tr>
								<td class="text-muted">Masa Berpori</td>
								<td>{{ $hydro->masa_berpori }}</td>
							</tr>
							<tr>
								<td class="text-muted">Keterangan</td>
								<td>{{ $hydro->keterangan }}</td>
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
