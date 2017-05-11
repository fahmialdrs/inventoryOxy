@extends('layouts.app')
@section('title', 'Tambah User')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/user') }}">Manajemen User</a></li>
				<li class="active">Tambah User</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah User</h2>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
						@include('user._form')                        
                    </form>
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection