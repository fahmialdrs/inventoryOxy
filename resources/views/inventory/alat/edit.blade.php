@extends('layouts.app')
@section('title','Edit Data Alat')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/inventory') }}">Data Inventory</a></li>
				<li class="active">Edit Data Alat</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Data Alat</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($alats, ['url'=>route('alat.update', $alats->id), 'method'=>'put', 'class'=>'form-horizontal', 'files' => 'true']) !!}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					    <label for="no_alat" class="col-md-4 control-label">Nomer Alat</label>

					    <div class="col-md-4">
					        <input id="no_alat" type="text" class="form-control" name="no_alat" value="{{ $alats->no_alat }}" disabled>

					        @if ($errors->has('no_alat'))
					            <span class="help-block">
					                <strong>{{ $errors->first('no_alat') }}</strong>
					            </span>
					        @endif
					    </div>
					</div>
					@include('inventory.alat._form')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection