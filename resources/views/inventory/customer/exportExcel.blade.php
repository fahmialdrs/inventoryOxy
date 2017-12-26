<html>
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

	<tr>
        <th>No Tabung</th>
        <!-- <th>Kandungan Gas</th> -->
        <th>Terakhir Hydrostatic</th>
        <th>Terakhir Visualstatic</th>
        <th>Status</th>
    </tr>
    @foreach ($customers->tube as $t)
    <tr>
        <td>{{ $t->no_tabung }}</td>
        <td>{{ $t->gas_diisikan }}</td>
        <td>{{ $t->terakhir_hydrostatic->format('M-Y') }}</td>
        <td>{{ $t->terakhir_visualstatic->format('M-Y') }}</td>
        <td>{{ $t->status }}</td>
    </tr>
    @endforeach
</html>