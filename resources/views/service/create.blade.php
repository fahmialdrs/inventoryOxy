@extends('layouts.app')
@section('title', 'Input Service')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/tabung') }}">Ujiriksa</a></li>
				<li class="active">Input Service</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Service</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url'=> route('service.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('service._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection