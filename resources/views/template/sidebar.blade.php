<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="@yield('classDashboard')"><a href="{{ route('dashboard') }}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li class="@yield('classCustomer')"><a href="{{ route('customer.index') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Customer</a></li>
			<li class="@yield('classTabung')"><a href="{{ route('tabung.index') }}"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Tabung</a></li>			
			<li class="@yield('classUjiriksa')"><a href="{{ route('ujiriksa.index') }}"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Uji Riksa</a></li>
			
			<li class="@yield('classUser')"><a href="{{ route('user.index') }}"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> User</a></li>
			
			<li class="@yield('classLaporan')"><a href="#"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Laporan</a></li>
			<li class="@yield('classBilling')"><a href="{{ route('billing.index')}}"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Billing</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Login Page</a></li>
		</ul>
		<div class="attribution">Developed By <a href="#">Fahmi</a><br/></div>
	</div><!--/.sidebar-->