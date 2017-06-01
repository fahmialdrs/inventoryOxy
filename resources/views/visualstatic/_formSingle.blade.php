<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi Uji</label>

    <div class="col-md-4">
        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $visual->itemujiriksa->formujiriksa->no_registrasi or old('no_registrasi') }}" disabled>

        @if ($errors->has('no_registrasi'))
            <span class="help-block">
                <strong>{{ $errors->first('no_registrasi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        <input id="customer_id" type="text" class="form-control" name="customer_id" value="{{ $visual->itemujiriksa->formujiriksa->customer->nama or old('customer_id') }}" disabled>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_uji') ? ' has-error' : '' }}">
    <label for="tanggal_uji" class="col-md-4 control-label">Tanggal Visual</label>

    <div class="col-md-4">
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $visual->itemujiriksa->formujiriksa->progress_at or old('tanggal_uji') }}" disabled>

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan_visual') ? ' has-error' : '' }}">
    <label for="keterangan_visual" class="col-md-4 control-label">Keterangan Visual</label>

    <div class="col-md-4">
        <textarea name="keterangan_visual"  class="form-control" cols="30" rows="10" required>{{ $visual->keterangan_visual or old('keterangan_visual') }}</textarea>

        @if ($errors->has('keterangan_visual'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan_visual') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan_visual') ? ' has-error' : '' }}">
    <label for="keterangan_visual" class="col-md-4 control-label">Keterangan Visual</label>

    <div class="col-md-4">
        <input type="file" name="fotovisual[]" multiple>

        @if ($errors->has('fotovisual'))
            <span class="help-block">
                <strong>{{ $errors->first('fotovisual') }}</strong>
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
        <button type="submit" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>