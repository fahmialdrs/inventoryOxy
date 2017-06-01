<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-2 control-label">No Registrasi Uji</label>

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
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        <input id="customer_id" type="text" class="form-control" name="customer_id" value="{{ $form->customer->nama or old('customer_id') }}" disabled>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('tanggal_uji') ? ' has-error' : '' }}">
    <label for="tanggal_uji" class="col-md-2 control-label">Tanggal Pemadatan</label>

    <div class="col-md-4">
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $form->progress_at or old('tanggal_uji') }}" >

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<table class="table table-bordered" style ="width:100%;">
    <thead>
        <tr>
            <th class="text-center" rowspan="2">No</th>
            <th class="text-center" rowspan="2">Gas yang diisikan</th>
            <th class="text-center" colspan="3">Keterangan Tabung</th>
            <th class="text-center" rowspan="2">Tekanan Kerja (Kg/Cm<sup>2</sup>)</th>
            <th class="text-center" rowspan="2">Tekanan Pemadatan (Kg/Cm<sup>2</sup>)</th>
            <th class="text-center" rowspan="2">Nama Pabrik Pembuat Tabung</th>
            <th class="text-center" rowspan="2">Nama Pabrik Pemakai Tabung</th>
            <th class="text-center" rowspan="2">Berat Tabung Yang Tercatat (Kg)</th>
            <th class="text-center" rowspan="2">Berat Tabung Sekarang (kg)</th>
            <th class="text-center" colspan="3">Selisih</th>
            <th class="text-center" rowspan="2">Isi Tabung (Ltr)</th>            
            <th class="text-center" rowspan="2">Air yang dipadatkan (cm<sup>3</sup>)</th>
            <th class="text-center" colspan="2">Pemuaian Tetap</th>
            <th class="text-center" rowspan="2">Suara Pukulan</th>
            <th class="text-center" rowspan="2">Keadaan Karat</th>
            <th class="text-center" rowspan="2">Keadaan Luar</th>
            <th class="text-center" rowspan="2">Masa Berpori</th>
            <th class="text-center" rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th class="text-center">No Tabung</th>            
            <th class="text-center">Kode Tabung</th>
            <th class="text-center">Warna Tabung</th>
            <th class="text-center">-</th>
            <th class="text-center">+</th>
            <th class="text-center">%</th>
            <th class="text-center">cm<sup>3</sup></th>
            <th class="text-center">%</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0; ?>
        @foreach($form->itemujiriksa as $t)
        <tr>
            <td width="70%"><b> {{ $a+1 }}</b></td>            
            <td>
                <div class="{{ $errors->has('gas_diisikan') ? ' has-error' : '' }}">
                    <input id="gas_diisikan" type="text" class="" name="hydrostaticresult[{{ $a }}][gas_diisikan]" value="{{ $t->tube->gas_diisikan or old('gas_diisikan') }}" disabled>

                    @if ($errors->has('gas_diisikan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gas_diisikan') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('tube_id') ? ' has-error' : '' }}">
                    <input id="tube_id" type="text" class="" name="hydrostaticresult[{{ $a }}][tube_id]" value="{{ $t->tube->no_tabung or old('tube_id') }}" disabled>
                    {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('kode_tabung') ? ' has-error' : '' }}">
                    <input id="kode_tabung" type="text" class="" name="hydrostaticresult[{{ $a }}][kode_tabung]" value="{{ $t->tube->kode_tabung or old('kode_tabung') }}" disabled>

                    @if ($errors->has('kode_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('kode_tabung') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('warna_tabung') ? ' has-error' : '' }}">
                    <input id="warna_tabung" type="text" class="" name="hydrostaticresult[{{ $a }}][warna_tabung]" value="{{ $t->tube->warna_tabung or old('warna_tabung') }}" disabled>

                    @if ($errors->has('warna_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('warna_tabung') }}</strong>
                        </span>
                    @endif
                </div> 
            </td>
            <td>
                <div class="{{ $errors->has('tekanan_kerja') ? ' has-error' : '' }}">
                    <input id="tekanan_kerja" type="number" class="" name="hydrostaticresult[{{ $a }}][tekanan_kerja]" value="{{ old('tekanan_kerja') }}" style="width: 5em" required>

                    @if ($errors->has('tekanan_kerja'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tekanan_kerja') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('tekanan_pemadatan') ? ' has-error' : '' }}">
                    <input id="tekanan_pemadatan" type="number" class="" name="hydrostaticresult[{{ $a }}][tekanan_pemadatan]" value="{{ old('tekanan_pemadatan') }}" style="width: 5em" required>

                    @if ($errors->has('tekanan_pemadatan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tekanan_pemadatan') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('pabrik_pembuat_tabung') ? ' has-error' : '' }}">
                    <input id="pabrik_pembuat_tabung" type="text" class="" name="hydrostaticresult[{{ $a }}][pabrik_pembuat_tabung]" value="{{ old('pabrik_pembuat_tabung') }}" required>

                    @if ($errors->has('pabrik_pembuat_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pabrik_pembuat_tabung') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('pabrik_pemakai_tabung') ? ' has-error' : '' }}">
                    <input id="pabrik_pemakai_tabung" type="text" class="" name="hydrostaticresult[{{ $a }}][pabrik_pemakai_tabung]" value="{{ old('pabrik_pemakai_tabung') }}" required>

                    @if ($errors->has('pabrik_pemakai_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pabrik_pemakai_tabung') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('berat_tercatat') ? ' has-error' : '' }}">
                    <input id="berat_tercatat" type="number" class="" name="hydrostaticresult[{{ $a }}][berat_tercatat]" value="{{ old('berat_tercatat') }}" style="width: 5em" required>

                    @if ($errors->has('berat_tercatat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('berat_tercatat') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('berat_sekarang') ? ' has-error' : '' }}">
                    <input id="berat_sekarang" type="number" class="" name="hydrostaticresult[{{ $a }}][berat_sekarang]" value="{{ old('berat_sekarang') }}" style="width: 5em" required>

                    @if ($errors->has('berat_sekarang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('berat_sekarang') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <input id="selisih-" type="number" class="" name="hydrostaticresult[{{ $a }}][selisih_min]" value="{{ old('selisih-') }}" style="width: 5em" required>       
            </td>
            <td>
                
                <input id="selisih+" type="number" class="" name="hydrostaticresult[{{ $a }}][selisih_plus]" value="{{ old('selisih+') }}" style="width: 5em" required>
            </td>
            <td>
                <input id="selisih%" type="number" class="" name="hydrostaticresult[{{ $a }}][selisih_pers]" value="{{ old('selisih%') }}" style="width: 5em" required>
            </td>
            <td>
                <div class="{{ $errors->has('isi_tabung') ? ' has-error' : '' }}">
                    <input id="isi_tabung" type="number" class="" name="hydrostaticresult[{{ $a }}][isi_tabung]" value="{{ $t->tube->isi_tabung or old('isi_tabung') }}" style="width: 5em" disabled>

                    @if ($errors->has('isi_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('isi_tabung') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('air_dipadatkan') ? ' has-error' : '' }}">
                    <input id="air_dipadatkan" type="number" class="" name="hydrostaticresult[{{ $a }}][air_dipadatkan]" value="{{ old('air_dipadatkan') }}" style="width: 5em" required>

                    @if ($errors->has('air_dipadatkan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('air_dipadatkan') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <input id="pemuaian_tetap_cm3" type="number" class="" name="hydrostaticresult[{{ $a }}][pemuaian_tetap_cm3]" value="{{ old('pemuaian_tetap_cm3') }}" style="width: 5em" required>
            </td>
            <td>
                <input id="pemuaian_tetap_%" type="number" class="" name="hydrostaticresult[{{ $a }}][pemuaian_tetap_pers]" value="{{ old('pemuaian_tetap_%') }}" style="width: 5em" required>
            </td>
            <td>
                <label class="radio-inline">
                    <input id="suara_pukulanNyaring" type="radio" name="hydrostaticresult[{{ $a }}][suara_pukulan]" value="nyaring" checked> Nyaring
                </label>
                <label class="radio-inline">
                    <input id="suara_pukulanPekak" type="radio" name="hydrostaticresult[{{ $a }}][suara_pukulan]" value="pekak"> Pekak
                </label>
            </td>
            <td>
                <div class="{{ $errors->has('keadaan_karat') ? ' has-error' : '' }}">
                    <input id="keadaan_karat" type="text" class="" name="hydrostaticresult[{{ $a }}][keadaan_karat]" value="{{ old('keadaan_karat') }}" required>

                    @if ($errors->has('keadaan_karat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keadaan_karat') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <label class="radio-inline">
                    <input id="keadaan_luarBerkeringat" type="radio" name="hydrostaticresult[{{ $a }}][keadaan_luar]" value="berkeringat" checked> Berkeringat
                </label>
                <label class="radio-inline">
                    <input id="keadaan_luarTidakberkeringat" type="radio" name="hydrostaticresult[{{ $a }}][keadaan_luar]" value="tidak berkeringat"> Tidak Berkeringat
                </label>
            </td>
            <td>
                <label class="radio-inline">
                    <input id="masa_berporiMerata" type="radio" name="hydrostaticresult[{{ $a }}][masa_berpori]" value="merata" checked> Merata
                </label>
                <label class="radio-inline">
                    <input id="masa_berporiTidakmerata" type="radio" name="hydrostaticresult[{{ $a }}][masa_berpori]" value="pekak"> Tidak Merata
                </label>
            </td>
            <td>
                <div class="{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                    <input id="keterangan" type="text" class="" name="hydrostaticresult[{{ $a }}][keterangan]" value="{{ old('keterangan') }}" required>

                    @if ($errors->has('keterangan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keterangan') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <input type="hidden"  name="hydrostaticresult[{{ $a }}][itemujiriksa_id]" value="{{ $t->id  }}">
            </td>
        </tr>
        <?php $a++ ?>
        @endforeach
    </tbody>
</table>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-lg btn-primary">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        <button type="submit" class="btn btn-warning btn-lg">
            Batal
        </button>
    </div>
</div>