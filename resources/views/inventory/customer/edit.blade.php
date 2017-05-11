@extends('layouts.app')
@section('title','Edit Customer')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/customer') }}">Customer</a></li>
				<li class="active">Edit Customer</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Customer</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($customers, ['url'=>route('customer.update', $customers->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('inventory.customer._form')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
	$(document).ready(function () {
			$('.js-selectize').selectize({
		sortField: 'text'
		});
	});
	</script>
@endsection