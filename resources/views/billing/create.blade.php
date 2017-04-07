@extends('template.main')
@section('title', 'Input Billing')
@section('classTabung','active')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="{{ route('billing.create') }}">Billing</a></li>
			<li class="active">Input Billing</li>
		</ul>
	</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">
		Input Billing
	</div>
		{!! Form::open(['url'=> route('customer.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
			@include('tabung._form')
		{!! Form::close() !!}
	</div>
@endsection