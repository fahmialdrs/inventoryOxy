<p>
	Dear {{ $alat->customer->nama }},
</p>

<p>
	Berikut kami sampaikan pemberitahuan untuk melakukan service alat:
	<br>	
</p>
<table>
	<tr>
		<td>Nama Alat</td>
		<td>:</td>
		<td>{{$alat->jenisalat->nama_alat}}</td>
	</tr>
	<tr>
		<td>No Alat</td>
		<td>:</td>
		<td>{{$alat->no_alat}}</td>
	</tr>
	<tr>
		<td>Terakhir Service</td>
		<td>:</td>
		<td>{{$alat->terakhir_service->format('d-m-Y')}}</td>
	</tr>
	<tr>
		<td>Service Selanjutnya</td>
		<td>:</td>
		<td>{{$alat->terakhir_service->addYears(1)->format('d-m-Y') }}</td>
	</tr>
</table>

<p>Make all checks payable to Pt. Nautika Dira Tera BCA Acc 505 550 3131</p>
<p>If you have any questions concerning this invoice, contact Adry, 021-7231132, adry@ndtdive.com</p>