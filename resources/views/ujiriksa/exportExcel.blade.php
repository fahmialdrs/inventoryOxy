<html>
	<tr>
		<th>No Registrasi</th>
		<th>Nama Pelanggan</th>
        <th>Jenis Uji</th>
        <th>Jenis Service</th>
        <th>Keterangan</th>
        <th>Tanggal Perkiraan Selesai</th>
        <th>Nama Barang</th>
        <th>No Tabung</th>
        <th>No Alat</th>
        <th>Jenis Alat</th>
        <th>Merk Alat</th>
        <th>Tipe Alat</th>
        <th>Keluhan</th>
        <th>Progress</th>
        <th>Tanggal Pengerjaan</th>
        <th>Tanggal Selesai</th>
    </tr>
    @foreach ($ujiriksas as $u)
    <tr>
        <td>{{ $u->formujiriksa->no_registrasi }}</td>
        <td>{{ $u->formujiriksa->customer->nama }}</td>
        <td>{{ $u->formujiriksa->jenis_uji }}</td>
        @if($u->formujiriksa->is_service_alat == false)
	        <td>Tabung</td>
	        <td>{{ $u->formujiriksa->keterangan }}</td>
	        <td>{{ date("d-m-Y", strtotime($u->formujiriksa->perkiraan_selesai)) }}</td>
	        <td>{{ $u->nama_barang }}</td>
	        <td>{{ $u->tube->no_tabung }}</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>-</td>
	        <td>{{ $u->keluhan }}</td>
	        <td>{{ $u->formujiriksa->progress }}</td>
	        @if(isset($u->formujiriksa->progress_at))
	        	<td>{{ $u->formujiriksa->progress_at->format('d-m-Y') }}</td>
	        @else
	        	<td>-</td>
	        @endif
	        @if(isset($u->formujiriksa->done_at))
	        	<td>{{ $u->formujiriksa->done_at->format('d-m-Y') }}</td>
	        @else
	        	<td>-</td>
	        @endif
        @elseif($u->formujiriksa->is_service_alat == true)
	        <td>Alat</td>
	        <td>{{ $u->formujiriksa->keterangan }}</td>
	        <td>{{ date("d-m-Y", strtotime($u->formujiriksa->perkiraan_selesai)) }}</td>
	        <td>{{ $u->nama_barang }}</td>
	        <td>-</td>
	        <td>{{ $u->alat->no_alat }}</td>
	        <td>{{ $u->alat->jenisalat->nama_alat }}</td>
	        <td>{{ $u->alat->merk->nama_merk }}</td>
	        <td>{{ $u->alat->tipe->nama_tipe }}</td>
	        <td>{{ $u->keluhan }}</td>
	        <td>{{ $u->formujiriksa->progress }}</td>
	        @if(isset($u->formujiriksa->progress_at))
	        	<td>{{ $u->formujiriksa->progress_at->format('d-m-Y') }}</td>
	        @else
	        	<td>-</td>
	        @endif
	        @if(isset($u->formujiriksa->done_at))
	        	<td>{{ $u->formujiriksa->done_at->format('d-m-Y') }}</td>
	        @else
	        	<td>-</td>
	        @endif
        @endif
    </tr>
    @endforeach
</html>