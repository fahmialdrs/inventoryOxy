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
						<div class="col-md 2">
						<table class="table table-responsive">
							<tr>
								<td class="text-muted">Bill To</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Email</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">No Telp</td>
								<td>{{ $billings->customer->no_telp }}</td>
							</tr>
							<tr>
								<td class="text-muted">Alamat</td>
								<td>{{ $billings->customer->nama }}</td>
							</tr>
							<tr>
								<td class="text-muted">Tanggal Invoice</td>
								<td>{{ $billings->tanggal_invoice }}</td>
							</tr>
						</table>
					</div>
						<table class="table">
						    <thead>
						        <tr>
						            <th>Quantity</th>
						            <th>Deskripsi</th>
						            <th>Unit Price</th>
						            <th>Amount</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach ($itembillings as $t)
						        <tr>
						            <td>{{ $t->quantity or '' }}</td>
						            <td>{{ $t->deskripsi or '' }}</td>
						            <td>{{ $t->unitprice or '' }}</td>
						            <td>{{ $t->amount or '' }}</td>
						        </tr>
						    @endforeach
						    </tbody>
						</table>
						<table class="table">
							<tr>
								<td class="text-muted">Subtotal</td>
								<td>{{ $billings->subtotal }}</td>
							</tr>
							<tr>
								<td class="text-muted">Ongkir</td>
								<td>{{ $billings->ongkir }}</td>
							</tr>
							<tr>
								<td class="text-muted">Discount</td>
								<td>{{ $billings->discount }}</td>
							</tr>
							<tr>
								<td class="text-muted">Total</td>
								<td>{{ $billings->total }}</td>
							</tr>
							<tr>
								<td class="text-muted">Terbilang</td>
								<td>{{ $billings->terbilang }}</td>
							</tr>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
