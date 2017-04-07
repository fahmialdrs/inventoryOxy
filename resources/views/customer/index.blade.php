@extends('template.main')
@section('title', 'Customer')
@section('classCustomer','active')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="{{ url('/home') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">Customer</li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data Customer</h1>
	</div>
</div><!--/.row-->

<div class="row">
	<div class="col-lg-12">
    	<div class="panel panel-default">
        	<div class="panel-heading">Data Customer</div>
            	<div class="panel-body">
					<div class="col-md-12">
						<a href="{{ route('customer.create') }}" class="btn btn-default">Tambah</a>
					</div>
            		<table data-toggle="table" data-url="{{ asset('tables/data1.json') }}"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true" >Item ID</th>
                                <th data-field="id" data-sortable="true">Item ID</th>
                                <th data-field="name"  data-sortable="true">Item Name</th>
                                <th data-field="price" data-sortable="true">Item Price</th>
                                <th data-field="action" data-sortable="false">Action</th>
                            </tr>
                            </thead>
                        </table>
                </div>
    	</div>
	</div>
</div><!--/.row-->
@endsection

@section('script')
	<script>
        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){        
                $(this).find('em:first').toggleClass("glyphicon-minus");      
            }); 
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
          if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
          if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
@endsection