@extends('layouts.app')
@section('title', 'Input Hasil Service')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/admin/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Layanan</a></li>
				<li class="active">Input Hasil Service</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Hasil Service</h2>
				</div>

				<div class="panel-body" style="overflow:auto; ">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
						@include('service._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection