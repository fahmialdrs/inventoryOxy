@extends('template.main')
@section('title', 'Input Ujiriksa')
@section('classTabung','active')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li><a href="{{ route('ujiriksa.index') }}">Ujiriksa</a></li>
			<li class="active">Input Ujiriksa</li>
		</ul>
	</div>
</div>
<div class="panel panel-info">
	<div class="panel-heading">
		Input Data Tabung
	</div>
		{!! Form::open(['url'=> route('customer.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
			@include('tabung._form')
		{!! Form::close() !!}
	</div>
@endsection