<!DOCTYPE html>
<html>
<head>
  <title>Ujiriksa</title>
    <link href="{{ public_path('/css/font-awesome.min.css') }}" rel="stylesheet" media="screen" title="no title" charset="utf-8">
    <link href="{{ public_path('/css/bootstrap.min.css') }}" rel="stylesheet" media="screen" title="no title" charset="utf-8">
    <link href="{{ public_path('/css/app.css') }}" rel="stylesheet" media="screen" title="no title" charset="utf-8">
    <style>
      .page-break {
          page-break-after: always;
      }
      body{
        background-color: white;
      }
      .line-height{
        line-height: 70%;
      }
    </style>

    <script src="{{ public_path('/js/jquery-3.2.0.min.js') }}" charset="utf-8"></script>
    <script src="{{ public_path('/js/bootstrap.min.js') }}" charset="utf-8"></script>
</head>
<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12">
          <span >
            <img src="{{ public_path('/img/logondt.png') }}" style="padding-bottom: 10px">
          </span>          
           <span class="line-height">
            <p>Epiwalk Office Suite Lt. 3 Unit B309 Komplek Rasuna Epicentrum</p> 
            <p>Jl. HR. Rasuna Said Kuningan Jakarta Selatan 12940.</p> 
            <p>Telp. +62 21 2994 1655  Fax. +62 21 29941744.</p> 
            <p>Workshop : Jl. KRI Ajak no.40C Komp. AL Radio Dalam Kebayoran Baru.</p>
            <p>JKT 12140 021-7231132/021-92698274</p>
          </span>
        </div>                  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title text-center">Form Tanda Terima {{ $ujiriksas->no_Registrasi }}</h1>
          </div>
          <div class="panel-body">
            <div class="col-md-2">
            <table class="table table-responsive">
              <tr>
                <td class="text-muted">Nama</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->customer->nama }}</td>
              </tr>
              <tr>
                <td class="text-muted">Email</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->customer->email }}</td>
              </tr>
              <tr>
                <td class="text-muted">No Telp</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->customer->no_telp }}</td>
              </tr>
              <tr>
                <td class="text-muted">Alamat</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->customer->alamat }}</td>
              </tr>
              <tr>
                <td class="text-muted">Tanggal Penerimaan</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->created_at }}</td>
              </tr>
            </table>
          </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Jumlah Barang</th>
                      <th>Nama Barang</th>
                      <th>No Tabung</th>
                      <th>Keluhan</th>
                    </tr>
                </thead>
                <tbody>
                <?php $a = 0; ?>
                @foreach ($ujiriksas->itemujiriksa as $t)
                    <tr>
                      <td><b><?php $a++ ?> {{ $a }}</b></td>
                      <td>{{ $t->jumlah_barang or '' }}</td>
                      <td>{{ $t->nama_barang or '' }}</td>
                      <td>{{ $t->tube->no_tabung or '' }}</td>
                      <td>{{ $t->keluhan or '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-2">
            <table class="table table-responsive">
              <tr>
                <td class="text-muted">Keterangan</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->keterangan }}</td>
              </tr>
              <tr>
                <td class="text-muted">Perkiraan Biaya</td>
                <td class="text-muted">:</td>
                <td>Rp. {{ $ujiriksas->perkiraan_biaya }}</td>
              </tr>
              <tr>
                <td class="text-muted">Perkiraan Selesai</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->perkiraan_selesai }}</td>
              </tr>
              <tr>
                <td class="text-muted">Diterima Oleh</td>
                <td class="text-muted">:</td>
                <td>{{ $ujiriksas->user->name }}</td>
              </tr>
              <tr> 
                <td class="text-muted"><b>Yang Menyerahkan</b></td>
                <td class="text-muted">:</td>
                <td><b>{{ $ujiriksas->nama_penyerah }}</b></td>
              </tr>
            </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
  <p><b><u>Syarat dan ketentuan yang disetujui bersama:</u></b></p>
  <p>
    <ol>
      <li>Apabila membatalkan service, maka customer tetap dikenakan bea service.</li>
      <li>Customer memberikan hak untuk penggantian sparepart (bila dibutuhkan) dan biaya ditanggung sepenuhnya diluar bea service.</li>
      <li>Barang yang telah selesai diservice, dan tidak diambil dalam waktu 3 (tiga) bulan, TIDAK menjadi tanggung jawab kami lagi.</li>
      <li>Kebakaran, banjir, ledakan, kecelakaan, dan force majeur adalah diluar tanggung jawab kami</li>
    </ol>
  </p>
</body>
</html>