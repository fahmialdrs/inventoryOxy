@extends('layouts.app')
@section('title', 'Input Visualstatic')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/ujiriksa') }}">Ujiriksa</a></li>
				<li class="active">Input Visualstatic</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Input Visualstatic</h2>
				</div>

				<div class="panel-body" style="overflow:auto; ">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('visualstatic.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
						@include('visualstatic._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection