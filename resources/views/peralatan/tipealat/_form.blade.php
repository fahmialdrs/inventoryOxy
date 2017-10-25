<div class="form-group{{ $errors->has('nama_tipe') ? ' has-error' : '' }}">
    <label for="nama_tipe" class="col-md-4 control-label">Nama Tipe Alat*</label>

    <div class="col-md-6">
        <input id="nama_tipe" type="text" class="form-control" name="nama_tipe" value="{{ $tipealats->nama_tipe or '' }}" required autofocus>

        @if ($errors->has('nama_tipe'))
            <span class="help-block">
                <strong>{{ $errors->first('nama_tipe') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('slugtipe') ? ' has-error' : '' }}">
    <label for="slugtipe" class="col-md-4 control-label">Singkatan Tipe Alat*</label>

    <div class="col-md-6">
        <input id="slugtipe" type="text" class="form-control" name="slugtipe" value="{{ $tipealats->slugtipe or '' }}" required autofocus>

        @if ($errors->has('slugtipe'))
            <span class="help-block">
                <strong>{{ $errors->first('slugtipe') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
    <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

    <div class="col-md-6">
        <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $tipealats->keterangan or '' }}">

        @if ($errors->has('keterangan'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>