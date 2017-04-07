@extends('template.main')
@section('title', 'Ujiriksa')
@section('classUjiriksa','active')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Ujiriksa</li>
        </ul>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data Ujiriksa</h1>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">Data Ujiriksa</div>
            	<div class="panel-body">
					<div class="col-md-12">
						<a href="{{ route('ujiriksa.create') }}" class="btn btn-default">Tambah Hydrostatic Test</a>
						<a href="{{ route('ujiriksa.create') }}" class="btn btn-default">Tambah Visual Test</a>
						<a href="{{ route('ujiriksa.create') }}" class="btn btn-default">Tambah Service</a>
					</div>            	
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