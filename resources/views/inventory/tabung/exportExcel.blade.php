<html>
	<tr>
		<td class="text-muted">No Tabung</td>
		<td>{{ $tabungs->no_tabung }}</td>
	</tr>
	<tr>
		<td class="text-muted">Pemilik</td>
		<td>{{ $tabungs->customer->nama }}</td>
	</tr>
<!-- 	<tr>
		<td class="text-muted">Gas yang Diisikan</td>
		<td>{{ $tabungs->gas_diisikan }}</td>
	</tr>
	<tr>
		<td class="text-muted">Kode Tabung</td>
		<td>{{ $tabungs->kode_tabung }}</td>
	</tr> -->
	<tr>
		<td class="text-muted">Warna Tabung</td>
		<td>{{ $tabungs->warna_tabung }}</td>
	</tr>
	<tr>
		<td class="text-muted">Isi Tabung</td>
		<td>{{ $tabungs->isi_tabung }} Liter</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Pembuatan Tabung</td>
		<td>{{ date("d-m-Y", strtotime($tabungs->tanggal_pembuatan)) }}</td>
	</tr>
	<tr>
		<td class="text-muted">Status Tabung</td>
		<td>{{ $tabungs->status }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Terakhir Hydrostatic</td>
		<td>{{ $tabungs->terakhir_hydrostatic->format('M-Y') }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Selanjutnya Hydrostatic</td>
		<td>{{ $tabungs->terakhir_hydrostatic->addYears(1)->format('M-Y') }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Terakhir Visualstatic</td>
		<td>{{ $tabungs->terakhir_visualstatic->format('d-m-Y') }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Selanjutnya Visualstatic</td>
		<td>{{ $tabungs->terakhir_visualstatic->addYears(1)->format('d-m-Y') }}</td>
	</tr>
	<tr>
		<td class="text-muted">Tanggal Terakhir Service</td>
		<td>{{ $tabungs->terakhir_service->format('d-m-Y') }}</td>
	</tr>
	<tr>
        <th>No Registrasi Kegiatan</th>
        <th>Jenis Kegiatan</th>
        <th>Keluhan</th>
        <th>Progress</th>
        <th>Tanggal Kegiatan</th>
    </tr>
    @foreach ($tabungs->itemujiriksa as $t)								    
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