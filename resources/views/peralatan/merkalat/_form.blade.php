<div class="form-group{{ $errors->has('nama_merk') ? ' has-error' : '' }}">
    <label for="nama_merk" class="col-md-4 control-label">Nama Merk Alat</label>

    <div class="col-md-6">
        <input id="nama_merk" type="text" class="form-control" name="nama_merk" value="{{ $merkalats->nama_merk or '' }}" required autofocus>

        @if ($errors->has('nama_merk'))
            <span class="help-block">
                <strong>{{ $errors->first('nama_merk') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
    <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

    <div class="col-md-6">
        <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $merkalats->keterangan or '' }}">

        @if ($errors->has('keterangan'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan') }}</strong>
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
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>