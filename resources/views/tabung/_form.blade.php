<div class="col-md-5">
	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('no_tabung', 'No Tabung', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('no_tabung', null, ['class'=>'form-control']) !!}
				{!! $errors->first('no_tabung', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('isi_gas') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('isi_gas', 'Isi Gas', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('isi_gas', null, ['class'=>'form-control']) !!}
				{!! $errors->first('isi_gas', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('kode_tabung') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('kode_tabung', 'Kode Tabung', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('kode_tabung', null, ['class'=>'form-control']) !!}
				{!! $errors->first('kode_tabung', '<p class="help-block">:message</p>') !!}
			</div>			
		</div>
	</div>
	<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
		<div class="col-md-12">
			<div class="panel-body">
				{!! Form::label('status', 'Status', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('status', null, ['class'=>'form-control']) !!}
				{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>	
</div>
<div class="col-md-7">
	<div class="form-group{{ $errors->has('warna_tabung') ? ' has-error' : '' }}">
		<div class="col-md-8">
			<div class="panel-body">
				{!! Form::label('warna_tabung', 'Warna Tabung', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('warna_tabung', null, ['class'=>'form-control']) !!}
				{!! $errors->first('warna_tabung', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('kapasitas_isiTabung') ? ' has-error' : '' }}">
		<div class="col-md-8">
			<div class="panel-body">
				{!! Form::label('kapasitas_isiTabung', 'Kapasitas Isi Tabung', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::text('kapasitas_isiTabung', null, ['class'=>'form-control']) !!}
				{!! $errors->first('kapasitas_isiTabung', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="form-group{{ $errors->has('tanggal_pembuatan') ? ' has-error' : '' }}">
		<div class="col-md-8">
			<div class="panel-body">
				{!! Form::label('tanggal_pembuatan', 'Tanggal Pembuatan', ['class'=>'col-md-2 control-label']) !!}
				{!! Form::date('tanggal_pembuatan', null, ['class'=>'form-control']) !!}
				{!! $errors->first('tanggal_pembuatan', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-md-10 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!}
		{!! Form::submit('Simpan & Buat Baru', ['class'=>'btn btn-primary']) !!}
		{!! Form::submit('Cancel', ['class'=>'btn btn-warning']) !!}
	</div>
</div>