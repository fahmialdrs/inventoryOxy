@extends('layouts.app')
@section('title', 'Input Hydrostatic')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Layanan</a></li>
				<li class="active">Input Hydrostatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Hydrostatic {{ $form->no_registrasi }}</h2>
				</div>

				<div class="panel-body" style="overflow:auto; ">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#form" aria-controls="form" role="tab" data-toggle="tab">
								<i class="fa fa-pencil-square-o"></i> Fill Form
							</a>
						</li>
						<li role="presentation">
							<a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">
								<i class="fa fa-cloud-upload"></i> Upload Excel
							</a>
						</li>						
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" role="tabpanel" id="form">
							{!! Form::open(['url' => route('hydrostatic.store'), 'method' => 'post', 'files' => 'true', 'class' => 'form-horizontal']) !!}
							@include('hydrostatic._form')
							{!! Form::close() !!}
						</div>
						<div class="tab-pane" role="tabpanel" id="upload">
							{!! Form::open(['url' => route('hydrostatic.import'), 'method' => 'post', 'files' => 'true', 'class' => 'form-horizontal']) !!}
							@include('hydrostatic._import')
							{!! Form::close() !!}
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection