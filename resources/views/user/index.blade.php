@extends('template.main')
@section('title', 'User')
@section('classUser','active')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">User</li>
        </ul>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data User</h1>
	</div>
</div><!--/.row-->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				Input Data User
			</div>
    		{!! Form::open(['url'=>'#', 'class' => 'form-horizontal']) !!}
    		@include('user._form')
			{!! Form::close() !!}
		</div>
	</div>			
</div><!-- /.row -->

<div class="row">
	<div class="col-lg-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">Data User</div>
            	<div class="panel-body">
                	<table data-toggle="table" data-url="{{ asset('tables/data1.json') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    	<thead>
                        	<tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">Item ID</th>
                                <th data-field="name"  data-sortable="true">Item Name</th>
                                <th data-field="price" data-sortable="true">Item Price</th>
                            </tr>
                        </thead>
            		</table>
        		</div>
    	</div>
	</div>
</div><!--/.row-->
@endsection