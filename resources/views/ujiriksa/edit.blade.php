@extends('layouts.app')
@section('title','Edit Form Registrasi Ujiriksa')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li class="active">Edit Form Registrasi Ujiriksa</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Form Registrasi Ujiriksa</h2>
				</div>
				<div class="panel-body" style="overflow:auto; ">
					<!-- <form class="form-horizontal" role="form" method="put" action="{{ route('ujiriksa.update', $ujiriksas->id) }}" enctype="multipart/form-data"> -->

					{!! Form::model($ujiriksas, ['url'=>route('ujiriksa.update', $ujiriksas->id), 'method'=>'put', 'files' => true, 'class'=>'form-horizontal']) !!}

					<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
					    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi</label>

					    <div class="col-md-4">
					        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $ujiriksas->no_registrasi }}" disabled>

					        @if ($errors->has('no_registrasi'))
					            <span class="help-block">
					                <strong>{{ $errors->first('no_registrasi') }}</strong>
					            </span>
					        @endif
					    </div>
					</div>
					
					@include('ujiriksa._form')
					{!! Form::close()!!}
					<!-- </form> -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection