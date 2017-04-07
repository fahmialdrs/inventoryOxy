@extends('template.main')
@section('title', 'Billing')
@section('classBilling','active')

@section('content')
<div class="row">
	<div class="col-lg-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">Laporan</div>
            	<div class="panel-body">
                    <div class="col-md-12">
                        <a href="{{ route('billing.create') }}" class="btn btn-default">Tambah</a>
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