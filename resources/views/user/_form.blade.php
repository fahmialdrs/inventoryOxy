<div class="col-md-12">
	<div class="panel-body">
	    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	    	{!! Form::label('name', 'Nama', ['class'=>'col-md-4 control-label']) !!}
	        <div class="col-md-6">
	        	{!! Form::text('name', null, ['class'=>'form-control']) !!}
	            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
	    </div>
	    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	    	{!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
	        <div class="col-md-6">
	        	{!! Form::email('email', null, ['class'=>'form-control']) !!}
	        	{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
	        </div>                        
		</div>
	    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	    	{!! Form::label('password', 'Password', ['class'=>'col-md-4 control-label']) !!}
	        <div class="col-md-6">
	        	{!! Form::password('password', ['class'=>'form-control']) !!}
	            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
			</div>
	    </div>
	    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	    	{!! Form::label('password_confirmation', 'Confirm Password ', ['class'=>'col-md-4 control-label']) !!}
	        <div class="col-md-6">
	        	{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
	            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
	        </div>
	    </div>
	    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
	    	{!! Form::label('role', 'Role ', ['class'=>'col-md-4 control-label']) !!}
	        <div class="col-md-6">
	        	{!! Form::select('role', ['management' => 'Management', 'pic' => 'pic'], 'management'); !!}
	            {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
	        </div>
	    </div>
	</div>
</div>
<div class="form-group">
	<div class="col-md-6 col-md-offset-4">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-btn fa-user"></i>Register
		</button>
	</div>
</div>