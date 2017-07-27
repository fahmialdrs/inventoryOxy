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

<p><b>PT. Nautika Dira Tera</b><br>
Epiwalk Office Suite Lt.3 Unit B309 Komp Rasuna Said Kuningan Jakarta Selatan 12940 <br>
Workshop : Jl. Kri Ajak No.40C Komp AL Radio Dalam Kebayoran Baru Jkt 12140 021-7231132</p>
<p>Contact : Fitri 021-7231132 <br>Email :info@ndtdive.com</p>