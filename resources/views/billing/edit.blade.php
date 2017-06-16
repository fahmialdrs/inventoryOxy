@extends('layouts.app')
@section('title','Edit Form Registrasi Service')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/service') }}">Billing</a></li>
				<li class="active">Edit Invoice</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Invoice</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($billings, ['url'=>route('billing.update', $billings->id), 'method'=>'put', 'class'=>'form-horizontal']) !!}

					<div class="form-group{{ $errors->has('no_invoice') ? ' has-error' : '' }}">
					    <label for="no_invoice" class="col-md-2 control-label">No Invoice</label>

					    <div class="col-md-4">
					        <input id="no_invoice" type="text" class="form-control" name="no_invoice" value="{{ $billings->no_invoice }}">

					        @if ($errors->has('no_invoice'))
					            <span class="help-block">
					                <strong>{{ $errors->first('no_invoice') }}</strong>
					            </span>
					        @endif
					    </div>
					</div>
					
					<input type="hidden" name="status" value="{{ $billings->status }}">
					
					@include('billing._form')
					{!! Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection