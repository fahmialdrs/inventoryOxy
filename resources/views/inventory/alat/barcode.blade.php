<!DOCTYPE html>
<html>
<head>
	<title>Print Barcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1 align="center">Barcode</h1>
<h2 align="center">{{ $data->no_alat}}</h2>
<br>
<div align="center">
	<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->merge('/public/img/logondt.png')->errorCorrection('H')->generate( $data->no_alat )) !!} ">

    <p>Scan Barcode ini.</p>
</div>
</body>
</html>