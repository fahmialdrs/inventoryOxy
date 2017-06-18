<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi Uji</label>

    <div class="col-md-4">
        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $service->itemujiriksa->formujiriksa->no_registrasi or old('no_registrasi') }}" disabled>

        @if ($errors->has('no_registrasi'))
            <span class="help-block">
                <strong>{{ $errors->first('no_registrasi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tube_id') ? ' has-error' : '' }}">
    {!! Form::label('tube_id', 'No Tabung', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        <input id="tube_id" type="text" class="form-control" name="tube_id" value="{{ $service->itemujiriksa->tube->no_tabung }}" disabled>
        {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        <input id="customer_id" type="text" class="form-control" name="customer_id" value="{{ $service->itemujiriksa->formujiriksa->customer->nama or old('customer_id') }}" disabled>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_uji') ? ' has-error' : '' }}">
    <label for="tanggal_uji" class="col-md-4 control-label">Tanggal Service</label>

    <div class="col-md-4">
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $service->itemujiriksa->formujiriksa->progress_at->format('Y-m-d') }}" disabled>

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan_service') ? ' has-error' : '' }}">
    <label for="keterangan_service" class="col-md-4 control-label">Keterangan Service</label>

    <div class="col-md-4">
        <textarea name="keterangan_service"  class="form-control" cols="30" rows="10" required>{{ $service->keterangan_service or old('keterangan_service') }}</textarea>

        @if ($errors->has('keterangan_service'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan_service') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('foto_tabung_service') ? ' has-error' : '' }}">
    <label for="foto_tabung_service" class="col-md-4 control-label">Foto Hasil Service</label>

    <div class="col-md-4">
        <input type="file" class="form-control" name="foto_tabung_service[]" multiple>
        @foreach ($service->fotoservice as $foto)
            <img src="{{ asset('storage/foto/'.$foto->foto_tabung_service) }}" class="img-rounded" width="100" height="75">
        @endforeach

        @if ($errors->has('foto_tabung_service'))
            <span class="help-block">
                <strong>{{ $errors->first('foto_tabung_service') }}</strong>
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