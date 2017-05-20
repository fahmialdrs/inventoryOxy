@extends('layouts.app')

@section('title', 'Detail Billing |' )

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}"> Dashboard</a></li>
					<li><a href="{{ url('/admin/billing') }}"> Billing</a></li>
					<li class="active">Detail Billing {{ $billings->no_invoice }} </li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Detail Billing {{ $billings->no_invoice }}</h2>
					</div>
					<div class="panel-body">					
						<a href="{{ route('billing.edit', $billings->id) }}" class="btn btn-primary">Edit</a>
						<br><br><br>
						<div class="col-md-6">
						<table class="table">
							<tr>
								<td class="text-muted">Bill To</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Email</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Telp</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->customer->no_telp }}</td>
							</tr>
							<tr>
								<td class="text-muted">Alamat</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Invoice</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->tanggal_invoice }}</td>
							</tr>
							<tr>
								<td class="text-muted">Dibuat Tanggal</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->created_at }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Terakhir Diubah</td>
								<td class="text-muted">:</td>
								<td>{{ $billings->updated_at }}</td>
							</tr>
						</table>
						</div>
						<table class="table table-condensed text-center">
			                <thead>
			                    <tr>
			                      <th class="text-center">No</th>
			                      <th class="text-center">Quantity</th>
			                      <th class="text-center">Deskripsi</th>
			                      <th class="text-center">Unit Price</th>
			                      <th class="text-center">Amount</th>
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
						<div class="col-md-6">
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
								<td>{{ $billings->discount }}</td>
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
@endsection
