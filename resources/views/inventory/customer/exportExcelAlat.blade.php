<html>
	<tr>
		<td class="text-muted">Nama Pemilik</td>
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

	<tr>
        <th>No Alat</th>
        <th>Nama Jenis Alat</th>
        <th>Nama Merk</th>
        <th>Nama Tipe</th>
        <th>Terakhir Service</th>
    </tr>
    @foreach ($customers->alat as $t)
    <tr>
        <td>{{ $t->no_alat }}</td>
        <td>{{ $t->jenisalat->nama_alat }}</td>
        <td>{{ $t->merk->nama_merk }}</td>
        <td>{{ $t->tipe->nama_tipe }}</td>
        <td>{{ $t->terakhir_service->format('d-m-Y') }}</td>
    </tr>
    @endforeach
</html>