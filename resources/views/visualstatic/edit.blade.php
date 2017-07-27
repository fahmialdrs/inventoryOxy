@extends('layouts.app')
@section('title','Edit Visualstatic')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Layanan</a></li>
				<li><a href="{{ url('/admin/ujiriksa/show', $visual->itemujiriksa->formujiriksa->id) }}"> Detail Layanan</a></li>
				<li class="active">Edit Hasil Visualstatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Visualstatic</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($visual, ['url'=>route('visualstatic.update', $visual->id), 'files' => true, 'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('visualstatic._formSingle')
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