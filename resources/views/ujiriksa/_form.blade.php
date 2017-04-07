<div class="col-md-5">
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('no_telp', 'Telpon', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('no_telp', null, ['class'=>'form-control']) !!}
				{!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('alamat', null, ['class'=>'form-control']) !!}
				{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
			</div>
			{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
		</div>
	</div>	
</div>
<div class="col-md-7">
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<div class="col-md-8">
			<div class="panel-body">
				{!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::email('email', null, ['class'=>'form-control']) !!}
				{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('tgl_member') ? ' has-error' : '' }}">
		<div class="col-md-8">
			<div class="panel-body">
				{!! Form::label('tgl_member', 'Tanggal Member', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::date('tgl_member', null, ['class'=>'form-control']) !!}
				{!! $errors->first('tgl_member', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-md-10 col-md-offset-2">
		
	</div>
</div>