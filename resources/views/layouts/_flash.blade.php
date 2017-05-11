@if(session()->has('flash_notification.message'))
	<div class="container">
		<div class="row">
			<div class="alert alert-{{ session('flash_notification.level') }}">
				<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
				{!! session()->get('flash_notification.message') !!}
			</div>
		</div>
	</div>
@endif