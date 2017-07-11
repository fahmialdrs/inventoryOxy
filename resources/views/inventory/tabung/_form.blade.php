<div class="form-group{{ $errors->has('no_tabung') ? ' has-error' : '' }}">
	{!! Form::label('no_tabung', 'No Tabung', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::text('no_tabung', null, ['class'=>'form-control', 'placeholder' => 'contoh: 090469']) !!}
		{!! $errors->first('no_tabung', '<p class="help-block">:message</p>') !!}		
	</div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
	{!! Form::label('customer_id', 'Pemilik', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Customer']) !!}
		{!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}		
	</div>
</div>

<div class="form-group{{ $errors->has('gas_diisikan') ? ' has-error' : '' }}">
	{!! Form::label('gas_diisikan', 'Gas yang diisikan', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::text('gas_diisikan', null, ['class'=>'form-control', 'placeholder' => 'contoh: Oxygen']) !!}
		{!! $errors->first('gas_diisikan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('kode_tabung') ? ' has-error' : '' }}">
	{!! Form::label('kode_tabung', 'Kode Tabung', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::text('kode_tabung', null, ['class'=>'form-control', 'placeholder' => 'contoh: O2']) !!}
		{!! $errors->first('kode_tabung', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('warna_tabung') ? ' has-error' : '' }}">
	{!! Form::label('warna_tabung', 'Warna Tabung', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::text('warna_tabung', null, ['class'=>'form-control', 'placeholder' => 'contoh: Biru']) !!}
		{!! $errors->first('warna_tabung', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('isi_tabung') ? ' has-error' : '' }}">
	{!! Form::label('isi_tabung', 'Isi Tabung', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		<div class="input-group">
			{!! Form::number('isi_tabung', null, ['class'=>'form-control', 'placeholder' => 'contoh: 47', 'min'=>1]) !!}
			<div class="input-group-addon">Liter</div>
		</div>
		{!! $errors->first('isi_tabung', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group{{ $errors->has('tanggal_pembuatan') ? ' has-error' : '' }}">
	{!! Form::label('tanggal_pembuatan', 'Tanggal Pembuatan', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::date('tanggal_pembuatan', null, ['class'=>'form-control']) !!}
		{!! $errors->first('tanggal_pembuatan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!}">
	{!! Form::label('status', 'Status', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-4 checkbox">
		@if(isset($tabungs->status))
			@if($tabungs->status == "Baik")
				{{ Form::radio('status', 'Baik', true) }} Baik
				{{ Form::radio('status', 'Afkir') }} Afkir
			@else
			{{ Form::radio('status', 'baik') }} Baik
				{{ Form::radio('status', 'afkir', true) }} Afkir
			@endif
		@else
			{{ Form::radio('status', 'Baik') }} Baik
			{{ Form::radio('status', 'Afkir') }} Afkir
		@endif
		{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
		</div>
</div>

<div class="form-group{{ $errors->has('terakhir_hydrostatic') ? ' has-error' : '' }}">
	{!! Form::label('terakhir_hydrostatic', 'Tanggal Terakhir Hydrostatic', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::date('terakhir_hydrostatic', null, ['class'=>'form-control']) !!}
		{!! $errors->first('terakhir_hydrostatic', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('terakhir_visualstatic') ? ' has-error' : '' }}">
	{!! Form::label('terakhir_visualstatic', 'Tanggal Terakhir Visualstatic', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::date('terakhir_visualstatic', null, ['class'=>'form-control']) !!}
		{!! $errors->first('terakhir_visualstatic', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('terakhir_service') ? ' has-error' : '' }}">
	{!! Form::label('terakhir_service', 'Tanggal Terakhir Service', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-4">
		{!! Form::date('terakhir_service', null, ['class'=>'form-control']) !!}
		{!! $errors->first('terakhir_service', '<p class="help-block">:message</p>') !!}
	</div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "tabung.edit")
        <button type="submit" name="new" class="btn btn-success" onclick="return confirm('Apakah Data Sudah Benar?')">
            Simpan & Buat Baru
        </button>
        @endif
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>