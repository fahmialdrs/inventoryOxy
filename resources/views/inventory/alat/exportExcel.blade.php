<html>
	<tr>
		<td class="text-muted">No Alat</td>
		<td>{{ $alats->no_alat }}</td>
	</tr>
	<tr>
		<td class="text-muted">Nama Pemilik</td>
		<td>{{ $alats->customer->nama }}</td>
	</tr>
	<tr>
		<td class="text-muted">Jenis Alat</td>
		<td>{{ $alats->jenisalat->nama_alat }}</td>
	</tr>
	<tr>
		<td class="text-muted">Merk Alat</td>
		<td>{{ $alats->merk->nama_merk }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tipe Alat</td>
		<td>{{ $alats->tipe }}</td>
	</tr>
	<tr>
		<td class="text-muted">Ukuran Alat</td>
		<td>{{ $alats->ukuran }}</td>
	</tr>
	<tr>
		<td class="text-muted">Warna Alat</td>
		<td>{{ $alats->warna }}</td>
	</tr>
	<tr>
		<td class="text-muted">Catatan</td>
		<td>{{ $alats->catatan }}</td>
	</tr>

	<tr>
        <th>No Registrasi Kegiatan</th>
        <th>Jenis Kegiatan</th>
        <th>Keluhan</th>
        <th>Progress</th>
        <th>Tanggal Kegiatan</th>
    </tr>
    @foreach ($alats->itemujiriksa as $t)								    
        <tr>
            <td>{{ $t->formujiriksa->no_registrasi or '' }}</td>
            <td>{{ $t->formujiriksa->jenis_uji or '' }}</td>
            <td>{{ $t->keluhan or '' }}</td>								            
            <td>{{ $t->formujiriksa->progress or '' }}</td>
            @if(isset($t->formujiriksa->done_at))
            <td>{{ $t->formujiriksa->done_at->format('d-m-Y')  }}</td>
            @else
            <td>{{ "Belum Selesai" }}</td>
            @endif
		</tr>
	@endforeach
</html>