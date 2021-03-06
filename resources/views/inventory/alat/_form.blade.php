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

<div class="form-group{{ $errors->has('tipe_id') ? ' has-error' : '' }}">
    {!! Form::label('tipe_id', 'Tipe Alat', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('tipe_id', [''=>'']+App\Models\Tipe::pluck('nama_tipe','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Tipe Alat']) !!}
        {!! $errors->first('tipe_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('ukuran') ? ' has-error' : '' }}">
    <label for="ukuran" class="col-md-4 control-label">Ukuran</label>

    <div class="col-md-4">
    @if(isset($alats->ukuran))
        <input id="ukuran" type="text" class="form-control" name="ukuran" value="{{ $alats->ukuran }}">
    @else
        <input id="ukuran" type="text" class="form-control" name="ukuran" value="{{ old('ukuran') }}">
    @endif
        @if ($errors->has('ukuran'))
            <span class="help-block">
                <strong>{{ $errors->first('ukuran') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('warna') ? ' has-error' : '' }}">
    <label for="warna" class="col-md-4 control-label">Warna Alat</label>

    <div class="col-md-4">
    @if(isset($alats->warna))
        <input id="warna" type="text" class="form-control" name="warna" value="{{ $alats->warna }}">
    @else
        <input id="warna" type="text" class="form-control" name="warna" value="{{ old('warna') }}">
    @endif
        @if ($errors->has('warna'))
            <span class="help-block">
                <strong>{{ $errors->first('warna') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('terakhir_service') ? ' has-error' : '' }}">
    <label for="terakhir_service" class="col-md-4 control-label">Terakhir Service</label>

    <div class="col-md-4">
    @if(isset($alats->terakhir_service))
        <input id="terakhir_service" type="date" class="form-control" name="terakhir_service" value="{{ $alats->terakhir_service->format('Y-m-d') }}">
    @else
        <input id="terakhir_service" type="date" class="form-control" name="terakhir_service" value="{{ old('terakhir_service') }}">
    @endif
        @if ($errors->has('terakhir_service'))
            <span class="help-block">
                <strong>{{ $errors->first('terakhir_service') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
    <label for="catatan" class="col-md-4 control-label">Catatan</label>

    <div class="col-md-4">
    @if(isset($alats->catatan))
        <textarea id="catatan" type="text" class="form-control" name="catatan">{{ $alats->catatan }}</textarea>
    @else
        <textarea id="catatan" type="text" class="form-control" name="catatan">{{ old('catatan') }}</textarea>
    @endif
        @if ($errors->has('catatan'))
            <span class="help-block">
                <strong>{{ $errors->first('catatan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
    <label for="foto" class="col-md-4 control-label">Foto</label>

    <div class="col-md-4">
        <input type="file" id="foto" class="form-control" name="foto" value="{{ old('foto') }}"> <br>
            @if(isset($alats->foto))
                <img src="{{ asset('storage/foto/'.$alats->foto) }}" class="img-rounded" width="100" height="75">
            @endif

        @if ($errors->has('foto'))
            <span class="help-block">
                <strong>{{ $errors->first('foto') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')"">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "alat.edit")
        <button type="submit" name="new" class="btn btn-success" onclick="return confirm('Apakah Data Sudah Benar?')">
            Simpan & Buat Baru
        </button>
        @endif
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>