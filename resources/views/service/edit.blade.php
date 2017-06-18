@extends('layouts.app')
@section('title','Edit Form Registrasi Service')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li><a href="{{ url('/admin/ujiriksa/show', $service->itemujiriksa->formujiriksa->id) }}"> Detail Ujiriksa</a></li>
				<li class="active">Edit Form Registrasi Service</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Form Registrasi Service</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($service, ['url'=>route('service.update', $service->id), 'files' => true, 'method'=>'put', 'class'=>'form-horizontal']) !!}

					@include('service._formSingle')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection