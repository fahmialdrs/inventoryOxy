@extends('layouts.app')
@section('title','Edit Hydrostatic')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li class="active">Edit Hydrostatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Ujiriksa</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($hydro, ['url'=>route('hydrostatic.update', $hydro->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('hydrostatic._formSingle')
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