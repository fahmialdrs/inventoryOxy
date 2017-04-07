<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>NDT</span>Dive</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
        				{{ Auth::user()->name }} <span class="caret"></span>
        				</a>
						<ul class="dropdown-menu" role="menu">
					        <li>
					        	<a href="{{ route('logout') }}"
					            	onclick="event.preventDefault();
					                document.getElementById('logout-form').submit();">
					                Logout
					            </a>

					            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					            	{{ csrf_field() }}
								</form>
							</li>
				        </ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>