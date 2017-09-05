@extends('layouts.app')
@section('title', 'Input Invoice')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/billing') }}">Billing</a></li>
				<li class="active">Input Invoice</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Invoice</h2>
				</div>

				<div class="panel-body">
					{!! Form::open(['url'=> route('billing.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
					@include('billing._formUji')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection