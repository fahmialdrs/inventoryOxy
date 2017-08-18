<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>
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
            <img src="{{ public_path('/img/logondt.png') }}" class="pull-left" style="margin-bottom:40px; margin-right: 15px; float: left;" height="65px">
            <p><b>PT. Nautika Dira Tera</b><br>
            Epiwalk Office Suite Lt. 3 Unit B309 Komplek Rasuna Epicentrum <br>
            Jl. HR. Rasuna Said Kuningan Jakarta Selatan 12940. <br>
            Workshop : Jl. KRI Ajak no.40C Komp. AL Radio Dalam Kebayoran Baru. <br>
            JKT 12140 021-7231132/021-92698274</p>
        </div>                  
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title text-center">INVOICE {{ $billings->no_invoice }}</h1>
          </div>
          <div class="panel-body">
            <div class="col-md-2">
            <table class="table table-responsive">
              <tr>
                <td class="text-muted">No Registrasi Layanan</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->formujiriksa->no_registrasi or '' }}</td>
              </tr>
              <tr>
                <td class="text-muted">Bill To</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->customer->nama }}</td>
              </tr>
              <tr>
                <td class="text-muted">Email</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->customer->email }}</td>
              </tr>
              <tr>
                <td class="text-muted">No Telp</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->customer->no_telp }}</td>
              </tr>
              <tr>
                <td class="text-muted">Alamat</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->customer->alamat }}</td>
              </tr>
              <tr>
                <td class="text-muted">Tanggal Invoice</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->tanggal_invoice }}</td>
              </tr>
            </table>
          </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Quantity</th>
                      <th>Deskripsi</th>
                      <th>Unit Price</th>
                      <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php $a = 0; ?>
                @foreach ($billings->itembilling as $t)
                    <tr>
                      <td><b><?php $a++ ?> {{ $a }}</b></td>
                      <td>{{ $t->quantity or '' }}</td>
                      <td>{{ $t->deskripsi or '' }}</td>
                      <td>{{ $t->unitprice or '' }}</td>
                      <td>{{ $t->amount or '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-2">
            <table class="table table-responsive">
              <tr>
                <td class="text-muted">Subtotal</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->subtotal }}</td>
              </tr>
              <tr>
                <td class="text-muted">Ongkir</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->ongkir }}</td>
              </tr>
              <tr>
                <td class="text-muted">Discount</td>
                <td class="text-muted">:</td>
                <td>Rp.{{ $billings->discount }}</td>
              </tr>
              <tr>
                <td class="text-muted">PPN</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->ppn }} %</td>
              </tr>
              <tr> 
                <td class="text-muted"><b>Total</b></td>
                <td class="text-muted">:</td>
                <td><b>{{ $billings->total }}</b></td>
              </tr>
              <tr>
                <td class="text-muted">Terbilang</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->terbilang }}</td>
              </tr>
              <tr>
                <td class="text-muted">Catatan</td>
                <td class="text-muted">:</td>
                <td>{{ $billings->catatan or '' }}</td>
              </tr>
            </table>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
  <p>Make all checks payable to Pt. Nautika Dira Tera BCA Acc 505 550 3131</p>
  <p>If you have any questions concerning this invoice, Contact Fitri 021-7231132, info@ndtdive.com</p>
</body>
</html>