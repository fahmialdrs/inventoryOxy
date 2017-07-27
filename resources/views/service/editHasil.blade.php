@extends('layouts.app')
@section('title','Edit Hasil Service')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Layanan</a></li>
				<li class="active">Edit Hasil Service</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Hasil Service</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($services, ['url'=>route('service.updateHasil', $services->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}

					<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
					    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi</label>

					    <div class="col-md-4">
					        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $services->no_registrasi }}" disabled>

					        @if ($errors->has('no_registrasi'))
					            <span class="help-block">
					                <strong>{{ $errors->first('no_registrasi') }}</strong>
					            </span>
					        @endif
					    </div>
					</div>
					
					@include('service._formHasil')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection