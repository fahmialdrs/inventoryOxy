@extends('layouts.app')
@section('title', 'Input Hydrostatic')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li class="active">Import Hydrostatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Import Hydrostatic</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url' => route('hydrostatic.import'), 'method' => 'post', 'files' => 'true', 'class' => 'form-horizontal']) !!}
					@include('hydrostatic._import')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection