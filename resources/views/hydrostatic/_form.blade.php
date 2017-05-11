<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi Uji</label>

    <div class="col-md-4">
        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $form->no_registrasi }}" disabled>

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
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Nama Customer']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tube_id') ? ' has-error' : '' }}">
    {!! Form::label('tube_id', 'No Tabung', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('tube_id', [''=>'']+App\Models\Tube::pluck('no_tabung','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih No Tabung']) !!}
        {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('gas_diisikan') ? ' has-error' : '' }}">
    <label for="gas_diisikan" class="col-md-4 control-label">Gas Yang Di Isikan</label>

    <div class="col-md-4">
        <input id="gas_diisikan" type="text" class="form-control" name="gas_diisikan" value="{{ old('gas_diisikan') }}" required>

        @if ($errors->has('gas_diisikan'))
            <span class="help-block">
                <strong>{{ $errors->first('gas_diisikan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_uji') ? ' has-error' : '' }}">
    <label for="tanggal_uji" class="col-md-4 control-label">Tanggal Pemadatan</label>

    <div class="col-md-4">
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ old('tanggal_uji') }}" required>

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('kode_tabung') ? ' has-error' : '' }}">
    <label for="kode_tabung" class="col-md-4 control-label">Kode Tabung</label>

    <div class="col-md-4">
        <input id="kode_tabung" type="text" class="form-control" name="kode_tabung" value="{{ old('kode_tabung') }}" required>

        @if ($errors->has('kode_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('kode_tabung') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('warna_tabung') ? ' has-error' : '' }}">
    <label for="warna_tabung" class="col-md-4 control-label">Warna Tabung</label>

    <div class="col-md-4">
        <input id="warna_tabung" type="text" class="form-control" name="warna_tabung" value="{{ old('warna_tabung') }}" required>

        @if ($errors->has('warna_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('warna_tabung') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tekanan_kerja') ? ' has-error' : '' }}">
    <label for="tekanan_kerja" class="col-md-4 control-label">Tekanan Kerja</label>

    <div class="col-md-4">
        <input id="tekanan_kerja" type="number" class="form-control" name="tekanan_kerja" value="{{ old('tekanan_kerja') }}" required>

        @if ($errors->has('tekanan_kerja'))
            <span class="help-block">
                <strong>{{ $errors->first('tekanan_kerja') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tekanan_pemadatan') ? ' has-error' : '' }}">
    <label for="tekanan_pemadatan" class="col-md-4 control-label">Tekanan Pemadatan</label>

    <div class="col-md-4">
        <input id="tekanan_pemadatan" type="number" class="form-control" name="tekanan_pemadatan" value="{{ old('tekanan_pemadatan') }}" required>

        @if ($errors->has('tekanan_pemadatan'))
            <span class="help-block">
                <strong>{{ $errors->first('tekanan_pemadatan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('pabrik_pembuat_tabung') ? ' has-error' : '' }}">
    <label for="pabrik_pembuat_tabung" class="col-md-4 control-label">Nama Pabrik Pembuat Tabung</label>

    <div class="col-md-4">
        <input id="pabrik_pembuat_tabung" type="text" class="form-control" name="pabrik_pembuat_tabung" value="{{ old('pabrik_pembuat_tabung') }}" required>

        @if ($errors->has('pabrik_pembuat_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('pabrik_pembuat_tabung') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('pabrik_pemakai_tabung') ? ' has-error' : '' }}">
    <label for="pabrik_pemakai_tabung" class="col-md-4 control-label">Nama Pabrik Pemakai Tabung</label>

    <div class="col-md-4">
        <input id="pabrik_pemakai_tabung" type="text" class="form-control" name="pabrik_pemakai_tabung" value="{{ old('pabrik_pemakai_tabung') }}" required>

        @if ($errors->has('pabrik_pemakai_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('pabrik_pemakai_tabung') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('berat_tercatat') ? ' has-error' : '' }}">
    <label for="berat_tercatat" class="col-md-4 control-label">Berat Tabung yang Tercatat</label>

    <div class="col-md-4">
        <input id="berat_tercatat" type="number" class="form-control" name="berat_tercatat" value="{{ old('berat_tercatat') }}" required>

        @if ($errors->has('berat_tercatat'))
            <span class="help-block">
                <strong>{{ $errors->first('berat_tercatat') }}</strong>
            </span>
        @endif
    </div> 
</div>

<div class="form-group{{ $errors->has('berat_sekarang') ? ' has-error' : '' }}">
    <label for="berat_sekarang" class="col-md-4 control-label">Berat Tabung Sekarang</label>

    <div class="col-md-4">
        <input id="berat_sekarang" type="number" class="form-control" name="berat_sekarang" value="{{ old('berat_sekarang') }}" required>

        @if ($errors->has('berat_sekarang'))
            <span class="help-block">
                <strong>{{ $errors->first('berat_sekarang') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('selisih') ? ' has-error' : '' }}">
    <label for="selisih" class="col-md-4 control-label">Selisih</label>

    <div class="col-md-4">
        <div class="input-group">
            <input id="selisih-" type="number" class="form-control" name="selisih-" value="{{ old('selisih-') }}" required>
            <div class="input-group-addon">-</div>
        </div>
        <div class="input-group">
            <input id="selisih+" type="number" class="form-control" name="selisih+" value="{{ old('selisih+') }}" required>
            <div class="input-group-addon">+</div>
        </div>
        <div class="input-group">
            <input id="selisih%" type="number" class="form-control" name="selisih%" value="{{ old('selisih%') }}" required>
            <div class="input-group-addon">%</div>
        </div>      

        @if ($errors->has('selisih'))
            <span class="help-block">
                <strong>{{ $errors->first('selisih') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('isi_tabung') ? ' has-error' : '' }}">
    <label for="isi_tabung" class="col-md-4 control-label">Isi Tabung</label>

    <div class="col-md-4">
        <input id="isi_tabung" type="text" class="form-control" name="isi_tabung" value="{{ old('isi_tabung') }}" required>

        @if ($errors->has('isi_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('isi_tabung') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('air_dipadatkan') ? ' has-error' : '' }}">
    <label for="air_dipadatkan" class="col-md-4 control-label">Air Yang Di Padatkan</label>

    <div class="col-md-4">
        <input id="air_dipadatkan" type="number" class="form-control" name="air_dipadatkan" value="{{ old('air_dipadatkan') }}" required>

        @if ($errors->has('air_dipadatkan'))
            <span class="help-block">
                <strong>{{ $errors->first('air_dipadatkan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('pemuaian_tetap') ? ' has-error' : '' }}">
    <label for="pemuaian_tetap" class="col-md-4 control-label">Pemuaian Tetap</label>

    <div class="col-md-4">
        <div class="input-group">
            <input id="pemuaian_tetap_cm3" type="number" class="form-control" name="pemuaian_tetap_cm3" value="{{ old('pemuaian_tetap_cm3') }}" required>
            <div class="input-group-addon">Cm3</div>
        </div>
        <div class="input-group">
            <input id="pemuaian_tetap_%" type="number" class="form-control" name="pemuaian_tetap_%" value="{{ old('pemuaian_tetap_%') }}" required>
            <div class="input-group-addon">%</div>
        </div>

        @if ($errors->has('pemuaian_tetap'))
            <span class="help-block">
                <strong>{{ $errors->first('pemuaian_tetap') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('suara_pukulan') ? ' has-error' : '' }}">
    <label for="pemuaian_tetap" class="col-md-4 control-label">Suara Pukulan</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="suara_pukulanNyaring" type="radio" name="suara_pukulan" value="nyaring" checked> Nyaring
        </label>
        <label class="radio-inline">
            <input id="suara_pukulanPekak" type="radio" name="suara_pukulan" value="pekak"> Pekak
        </label>

        @if ($errors->has('suara_pukulan'))
            <span class="help-block">
                <strong>{{ $errors->first('suara_pukulan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keadaan_karat') ? ' has-error' : '' }}">
    <label for="keadaan_karat" class="col-md-4 control-label">Keadaan Karat</label>

    <div class="col-md-4">
        <input id="keadaan_karat" type="text" class="form-control" name="keadaan_karat" value="{{ old('keadaan_karat') }}" required>

        @if ($errors->has('keadaan_karat'))
            <span class="help-block">
                <strong>{{ $errors->first('keadaan_karat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keadaan_luar') ? ' has-error' : '' }}">
    <label for="keadaan_luar" class="col-md-4 control-label">Keadaan Luar</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="keadaan_luarBerkeringat" type="radio" name="keadaan_luar" value="berkeringat" checked> Berkeringat
        </label>
        <label class="radio-inline">
            <input id="keadaan_luarTidakberkeringat" type="radio" name="keadaan_luar" value="tidak berkeringat"> Tidak Berkeringat
        </label>

        @if ($errors->has('keadaan_luar'))
            <span class="help-block">
                <strong>{{ $errors->first('keadaan_luar') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('masa_berpori') ? ' has-error' : '' }}">
    <label for="masa_berpori" class="col-md-4 control-label">Masa Berpori</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="masa_berporiMerata" type="radio" name="masa_berpori" value="merata" checked> Merata
        </label>
        <label class="radio-inline">
            <input id="masa_berporiTidakmerata" type="radio" name="masa_berpori" value="pekak"> Tidak Merata
        </label>

        @if ($errors->has('masa_berpori'))
            <span class="help-block">
                <strong>{{ $errors->first('masa_berpori') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
    <label for="keterangan" class="col-md-4 control-label">keterangan</label>

    <div class="col-md-4">
        <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" required>

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
        <button type="submit" class="btn btn-success">
            Simpan & Buat Baru
        </button>
        <button type="submit" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>