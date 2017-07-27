<html>
	<tr>
		<th>Nama Pemilik</th>
		<th>No Alat</th>
        <th>Jenis Alat</th>
        <th>Merk Alat</th>
        <th>Tipe Alat</th>
        <th>Ukuran Alat</th>
        <th>Warna Alat</th>
        <th>Terakhir Service</th>
        <th>Catatan</th>
    </tr>
    @foreach ($alats as $a)
    <tr>
        <td>{{ $a->customer->nama }}</td>
        <td>{{ $a->no_alat }}</td>
        <td>{{ $a->jenisalat->nama_alat }}</td>
        <td>{{ $a->merk->nama_merk }}</td>
        <td>{{ $a->tipe->nama_tipe }}</td>
        <td>{{ $a->ukuran }}</td>
        <td>{{ $a->warna }}</td>
        <td>{{ $a->terakhir_service->format('d-m-Y') }}</td>
        <td>{{ $a->catatan }}</td>
    </tr>
    @endforeach
</html>