<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-4 control-label">No Registrasi Uji</label>

    <div class="col-md-4">
        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $hydro->itemujiriksa->formujiriksa->no_registrasi }}" disabled>

        @if ($errors->has('no_registrasi'))
            <span class="help-block">
                <strong>{{ $errors->first('no_registrasi') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-sm-4">
        <input id="customer_id" type="text" class="form-control" name="customer_id" value="{{ $hydro->itemujiriksa->formujiriksa->customer->nama or old('customer_id') }}" disabled>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tube_id') ? ' has-error' : '' }}">
    {!! Form::label('tube_id', 'No Tabung', ['class'=>'col-md-4 control-label']) !!}
    <div class="col-sm-4">
        <input id="tube_id" type="text" class="form-control" name="tube_id" value="{{ $hydro->itemujiriksa->tube->no_tabung or old('tube_id') }}" disabled>
        {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('gas_diisikan') ? ' has-error' : '' }}">
    <label for="gas_diisikan" class="col-md-4 control-label">Gas Yang Di Isikan</label>

    <div class="col-md-4">
        <input id="gas_diisikan" type="text" class="form-control" name="gas_diisikan" value="{{ $hydro->itemujiriksa->tube->gas_diisikan or old('gas_diisikan') }}" disabled>

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
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $hydro->tanggal_uji or old('tanggal_uji') }}" required>

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
        <input id="kode_tabung" type="text" class="form-control" name="kode_tabung" value="{{ $hydro->itemujiriksa->tube->kode_tabung or old('kode_tabung') }}" disabled>

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
        <input id="warna_tabung" type="text" class="form-control" name="warna_tabung" value="{{ $hydro->itemujiriksa->tube->warna_tabung or old('warna_tabung') }}" disabled>

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
        <input id="tekanan_kerja" type="number" class="form-control" name="tekanan_kerja" value="{{ $hydro->tekanan_kerja or old('tekanan_kerja') }}" required>

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
        <input id="tekanan_pemadatan" type="number" class="form-control" name="tekanan_pemadatan" value="{{ $hydro->tekanan_pemadatan or old('tekanan_pemadatan') }}" required>

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
        <input id="pabrik_pembuat_tabung" type="text" class="form-control" name="pabrik_pembuat_tabung" value="{{ $hydro->pabrik_pembuat_tabung or old('pabrik_pembuat_tabung') }}" required>

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
        <input id="pabrik_pemakai_tabung" type="text" class="form-control" name="pabrik_pemakai_tabung" value="{{ $hydro->pabrik_pemakai_tabung or old('pabrik_pemakai_tabung') }}" required>

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
        <input id="berat_tercatat" type="number" class="form-control" name="berat_tercatat" value="{{ $hydro->berat_tercatat or old('berat_tercatat') }}" required>

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
        <input id="berat_sekarang" type="number" class="form-control" name="berat_sekarang" value="{{ $hydro->berat_sekarang or old('berat_sekarang') }}" required>

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
            <input id="selisih_min" type="number" class="form-control" name="selisih_min" value="{{ $hydro->selisih_min or old('selisih_min') }}" required>
            <div class="input-group-addon">-</div>
        </div>
        <div class="input-group">
            <input id="selisih_plus" type="number" class="form-control" name="selisih_plus" value="{{ $hydro->selisih_plus or old('selisih_plus') }}" required>
            <div class="input-group-addon">+</div>
        </div>
        <div class="input-group">
            <input id="selisih_pers" type="number" class="form-control" name="selisih_pers" value="{{ $hydro->selisih_pers or old('selisih_pers') }}" required>
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
        <input id="isi_tabung" type="text" class="form-control" name="isi_tabung" value="{{ $hydro->itemujiriksa->tube->isi_tabung or old('isi_tabung') }}" disabled>

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
        <input id="air_dipadatkan" type="number" class="form-control" name="air_dipadatkan" value="{{ $hydro->air_dipadatkan or old('air_dipadatkan') }}" required>

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
            <input id="pemuaian_tetap_cm3" type="number" class="form-control" name="pemuaian_tetap_cm3" value="{{ $hydro->pemuaian_tetap_cm3 or old('pemuaian_tetap_cm3') }}" required>
            <div class="input-group-addon">Cm<sup>3</sup></div>
        </div>
        <div class="input-group">
            <input id="pemuaian_tetap_pers" type="number" class="form-control" name="pemuaian_tetap_pers" value="{{ $hydro->pemuaian_tetap_pers or old('pemuaian_tetap_pers') }}" required>
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
        @if($hydro->suara_pukulan == "nyaring")
        <label class="radio-inline">
            <input id="suara_pukulanNyaring" type="radio" name="suara_pukulan" value="nyaring" checked> Nyaring
        </label>
        <label class="radio-inline">
            <input id="suara_pukulanPekak" type="radio" name="suara_pukulan" value="pekak"> Pekak
        </label>
        @else
        <label class="radio-inline">
            <input id="suara_pukulanNyaring" type="radio" name="suara_pukulan" value="nyaring"> Nyaring
        </label>
        <label class="radio-inline">
            <input id="suara_pukulanPekak" type="radio" name="suara_pukulan" value="pekak" checked> Pekak
        </label>
        @endif

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
        <input id="keadaan_karat" type="text" class="form-control" name="keadaan_karat" value="{{ $hydro->keadaan_karat or old('keadaan_karat') }}" required>

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
        @if($hydro->keadaan_luar == "berkeringat")
        <label class="radio-inline">
            <input id="keadaan_luarBerkeringat" type="radio" name="keadaan_luar" value="berkeringat" checked> Berkeringat
        </label>
        <label class="radio-inline">
            <input id="keadaan_luarTidakberkeringat" type="radio" name="keadaan_luar" value="tidak berkeringat"> Tidak Berkeringat
        </label>
        @else
        <label class="radio-inline">
            <input id="keadaan_luarBerkeringat" type="radio" name="keadaan_luar" value="berkeringat"> Berkeringat
        </label>
        <label class="radio-inline">
            <input id="keadaan_luarTidakberkeringat" type="radio" name="keadaan_luar" value="tidak berkeringat" checked> Tidak Berkeringat
        </label>
        @endif

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
        @if($hydro->masa_berpori == "merata")
        <label class="radio-inline">
            <input id="masa_berporiMerata" type="radio" name="masa_berpori" value="merata" checked> Merata
        </label>
        <label class="radio-inline">
            <input id="masa_berporiTidakmerata" type="radio" name="masa_berpori" value="pekak"> Tidak Merata
        </label>
        @else
        <label class="radio-inline">
            <input id="masa_berporiMerata" type="radio" name="masa_berpori" value="merata"> Merata
        </label>
        <label class="radio-inline">
            <input id="masa_berporiTidakmerata" type="radio" name="masa_berpori" value="pekak" checked> Tidak Merata
        </label>
        @endif

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
        <input id="keterangan" type="text" class="form-control" name="keterangan" value="{{ $hydro->keterangan or old('keterangan') }}" required>

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
        <button type="submit" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>