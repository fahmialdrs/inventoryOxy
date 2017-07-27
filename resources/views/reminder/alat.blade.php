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
		<td>{{$alat->terakhir_service->format('d-M-Y')}}</td>
	</tr>
	<tr>
		<td>Service Selanjutnya</td>
		<td>:</td>
		<td>{{$alat->terakhir_service->addYears(1)->format('d-M-Y') }}</td>
	</tr>
</table>

<p><b>PT. Nautika Dira Tera</b><br>
Epiwalk Office Suite Lt.3 Unit B309 Komp Rasuna Said Kuningan Jakarta Selatan 12940 <br>
Workshop : Jl. Kri Ajak No.40C Komp AL Radio Dalam Kebayoran Baru Jkt 12140 021-7231132</p>
<p>Contact : Fitri 021-7231132 <br>Email :info@ndtdive.com</p>