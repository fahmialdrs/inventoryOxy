@extends('layouts.app')
@section('title', 'Input Customer')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/inventory') }}">Data Inventory</a></li>
				<li class="active">Input Customer</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Customer</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url'=> route('customer.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('inventory.customer._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection