<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="no_alat" class="col-md-4 control-label">Nomer Alat</label>

    <div class="col-md-4">
        <input id="no_alat" type="text" class="form-control" name="no_alat" value="{{ old('no_alat') }}" required autofocus>

        @if ($errors->has('no_alat'))
            <span class="help-block">
                <strong>{{ $errors->first('no_alat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Pemilik', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Customer']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('jenisalat_id') ? ' has-error' : '' }}">
    {!! Form::label('jenisalat_id', 'Jenis Alat', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('jenisalat_id', [''=>'']+App\Models\Jenisalat::pluck('nama_alat','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Jenis Alat']) !!}
        {!! $errors->first('jenisalat_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('merk_id') ? ' has-error' : '' }}">
    {!! Form::label('merk_id', 'Merk Alat', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('merk_id', [''=>'']+App\Models\Merk::pluck('nama_merk','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Merk Alat']) !!}
        {!! $errors->first('merk_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tipe') ? ' has-error' : '' }}">
    <label for="tipe" class="col-md-4 control-label">Tipe Alat</label>

    <div class="col-md-4">
        <input id="tipe" type="text" class="form-control" name="tipe" value="{{ old('tipe') }}">

        @if ($errors->has('tipe'))
            <span class="help-block">
                <strong>{{ $errors->first('tipe') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('ukuran') ? ' has-error' : '' }}">
    <label for="ukuran" class="col-md-4 control-label">Ukuran</label>

    <div class="col-md-4">
        <input id="ukuran" type="text" class="form-control" name="ukuran" value="{{ old('ukuran') }}">

        @if ($errors->has('ukuran'))
            <span class="help-block">
                <strong>{{ $errors->first('ukuran') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
    <label for="catatan" class="col-md-4 control-label">Catatan</label>

    <div class="col-md-4">
        <textarea id="catatan" type="text" class="form-control" name="catatan">{{ old('catatan') }}</textarea>

        @if ($errors->has('catatan'))
            <span class="help-block">
                <strong>{{ $errors->first('catatan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "alat.edit")
        <button type="submit" class="btn btn-success">
            Simpan & Buat Baru
        </button>
        @endif
        <button type="submit" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>