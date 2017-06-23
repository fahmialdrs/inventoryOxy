@extends('layouts.app')
@section('title', 'Registrasi Layanan')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Layanan</a></li>
				<li class="active">Registrasi Layanan</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Form Registrasi Layanan</h2>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('ujiriksa.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
					@include('ujiriksa._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
