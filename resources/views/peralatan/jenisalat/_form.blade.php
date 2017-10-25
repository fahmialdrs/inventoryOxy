<div class="form-group{{ $errors->has('nama_alat') ? ' has-error' : '' }}">
    <label for="nama_alat" class="col-md-4 control-label">Nama Jenis Alat*</label>

    <div class="col-md-6">
        <input id="nama_alat" type="text" class="form-control" name="nama_alat" value="{{ $jenisalats->nama_alat or '' }}" required autofocus>

        @if ($errors->has('nama_alat'))
            <span class="help-block">
                <strong>{{ $errors->first('nama_alat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('slugjenis') ? ' has-error' : '' }}">
    <label for="slugjenis" class="col-md-4 control-label">Singkatan Jenis Alat*</label>

    <div class="col-md-6">
        <input id="slugjenis" type="text" class="form-control" name="slugjenis" value="{{ $jenisalats->slugjenis or '' }}" required autofocus>

        @if ($errors->has('slugjenis'))
            <span class="help-block">
                <strong>{{ $errors->first('slugjenis') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
    <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

    <div class="col-md-6">
        <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $jenisalats->keterangan or '' }}">

        @if ($errors->has('keterangan'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('reminder') ? ' has-error' : '' }}">
    <label for="reminder" class="col-md-4 control-label">Reminder</label>

    <div class="col-md-6">
        <label class="radio-inline">
        	<input type="radio" name="reminder" value="0" checked> Tidak
		</label>
		<label class="radio-inline">
        	<input type="radio" name="reminder" value="1"> Ya
		</label>

        @if ($errors->has('reminder'))
            <span class="help-block">
                <strong>{{ $errors->first('reminder') }}</strong>
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