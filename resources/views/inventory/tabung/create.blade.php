@extends('layouts.app')
@section('title', 'Input Tabung')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/inventory') }}">Data Inventory</a></li>
				<li class="active">Input Tabung</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Tabung</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url'=> route('tabung.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('inventory.tabung._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
