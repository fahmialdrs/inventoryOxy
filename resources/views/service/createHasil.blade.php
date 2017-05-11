@extends('layouts.app')
@section('title', 'Input Hasil Service')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/service') }}">Service</a></li>
				<li class="active">Input Hasil Service</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Hasil Service</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url'=> route('service.storeHasil'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('service._formHasil')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection