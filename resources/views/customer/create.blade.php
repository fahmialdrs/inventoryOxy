@extends('template.main')
@section('title', 'Edit Customer')
@section('classCustomer','active')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="{{ route('customer.create') }}">Customer</a></li>
			<li class="active">Input Customer</li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="{{ route('customer.index') }}">Customer</a></li>
			<li class="active">Input Customer</li>
		</ul>
	</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">
		Input Data Customer
	</div>
	{!! Form::open(['url'=> route('customer.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
		@include('customer._form')
	{!! Form::close() !!}
</div>
@endsection

