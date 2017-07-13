<p>
	Dear {{ $tabung->customer->nama }},
</p>

<p>
	Berikut kami sampaikan pemberitahuan untuk melakukan uji hydrostatic tabung:
	<br>	
</p>
<table>
	<tr>
		<td>No Tabung</td>
		<td>:</td>
		<td>{{$tabung->no_tabung}}</td>
	</tr>
	<tr>
		<td>Terakhir Hydrostatic</td>
		<td>:</td>
		<td>{{$tabung->terakhir_hydrostatic->format('d-m-Y')}}</td>
	</tr>
	<tr>
		<td>Hydrostatic Selanjutnya</td>
		<td>:</td>
		<td>{{$tabung->terakhir_hydrostatic->addYears(5)->format('d-m-Y') }}</td>
	</tr>
</table>

<p>Make all checks payable to Pt. Nautika Dira Tera BCA Acc 505 550 3131</p>
<p>If you have any questions concerning this invoice, contact Adry, 021-7231132, adry@ndtdive.com</p>