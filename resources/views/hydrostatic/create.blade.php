@extends('layouts.app')
@section('title', 'Input Hydrostatic')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li class="active">Input Hydrostatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Hydrostatic {{ $form->no_registrasi }}</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url' => route('hydrostatic.store'), 'method' => 'post', 'files' => 'true', 'class' => 'form-horizontal']) !!}
					@include('hydrostatic._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection