@extends('layouts.app')
@section('title','Edit Tabung')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/inventory') }}">Tabung</a></li>
				<li class="active">Edit Tabung</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Tabung</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($tabungs, ['url'=>route('tabung.update', $tabungs->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('inventory.tabung._form')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<!-- 	<script>
	$(document).ready(function () {
			$('.js-selectize').selectize({
		sortField: 'text'
		});
	});
	</script> -->
@endsection