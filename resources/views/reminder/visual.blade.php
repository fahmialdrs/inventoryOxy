<p>
	Dear {{ $tabung->customer->nama }},
</p>

<p>
	Berikut kami sampaikan pemberitahuan untuk melakukan uji Visualstatic tabung:
	<br>	
</p>
<table>
	<tr>
		<td>No Tabung</td>
		<td>:</td>
		<td>{{$tabung->no_tabung}}</td>
	</tr>
	<tr>
		<td>Terakhir Visualstatic</td>
		<td>:</td>
		<td>{{$tabung->terakhir_visualstatic->format('d-m-Y')}}</td>
	</tr>
	<tr>
		<td>:</td>
		<td>Visualstatic Selanjutnya</td>
		<td>{{$tabung->terakhir_visualstatic->addYears(1)->format('d-m-Y') }}</td>
	</tr>
</table>

<p>Make all checks payable to Pt. Nautika Dira Tera BCA Acc 505 550 3131</p>
<p>If you have any questions concerning this invoice, contact Adry, 021-7231132, adry@ndtdive.com</p>