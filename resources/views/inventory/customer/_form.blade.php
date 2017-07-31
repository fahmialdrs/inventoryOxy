	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		{!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
			<div class="col-md-4">
				{!! Form::text('nama', null, ['class'=>'form-control']) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
	<div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
		{!! Form::label('no_telp', 'Telpon', ['class'=>'col-md-2 control-label']) !!}
			<div class="col-md-4">
				{!! Form::text('no_telp', null, ['class'=>'form-control']) !!}
				{!! $errors->first('no_telp', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
	
	<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
		{!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
			<div class="col-md-4">
				{!! Form::text('alamat', null, ['class'=>'form-control']) !!}
				{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
	
	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		{!! Form::label('email', 'Email', ['class'=>'col-md-2 control-label']) !!}
			<div class="col-md-4">
				{!! Form::email('email', null, ['class'=>'form-control']) !!}
				{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
	
	<div class="form-group{{ $errors->has('tanggal_member') ? ' has-error' : '' }}">
		{!! Form::label('tanggal_member', 'Tanggal Member', ['class'=>'col-md-2 control-label']) !!}
			<div class="col-md-4">
				{!! Form::date('tanggal_member', null, ['class'=>'form-control']) !!}
				{!! $errors->first('tanggal_member', '<p class="help-block">:message</p>') !!}
			</div>
	</div>
	
<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "customer.edit")
        <button type="submit" name="new" class="btn btn-success">
            Simpan & Buat Baru
        </button>
        @endif
        <a href="{{ route('customer.index') }}" class="btn btn-warning">
        	Batal
        </a>
        <!-- <button type="submit" class="btn btn-warning">
            Batal
        </button> -->
    </div>
</div>
