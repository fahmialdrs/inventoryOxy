<div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
    <label for="no_registrasi" class="col-md-2 control-label">No Registrasi Uji</label>

    <div class="col-md-4">
        <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ $form->no_registrasi }}">

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
    <label for="tanggal_uji" class="col-md-2 control-label">Tanggal Service</label>

    <div class="col-md-4">
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $form->progress_at->format('Y-m-d') }}" disabled>

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">No Tabung</th>
            <th class="text-center">Jumlah Barang</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Keluhan</th>
            <th class="text-center">Keterangan Hasil Visualstatic</th>
            <th class="text-center">Foto Hasil Visual</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0; ?>
        @foreach($form->itemujiriksa as $t)
        <tr>
            <td><b> {{ $a+1 }}</b></td>            
            <td>
                <div class="{{ $errors->has('tube_id') ? ' has-error' : '' }}">
                    <input id="tube_id" type="text" class="" name="visualresult[{{ $a }}][tube_id]" value="{{ $t->tube->no_tabung or old('tube_id') }}" disabled>
                    {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('jumlah_barang') ? ' has-error' : '' }}">
                    <input id="jumlah_barang" type="text" class="" name="visualresult[{{ $a }}][jumlah_barang]" value="{{ $t->jumlah_barang or old('jumlah_barang') }}" disabled>

                    @if ($errors->has('kode_tabung'))
                        <span class="help-block">
                            <strong>{{ $errors->first('kode_tabung') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <div class="{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                    <input id="nama_barang" type="text" class="" name="visualresult[{{ $a }}][nama_barang]" value="{{ $t->nama_barang or old('nama_barang') }}" disabled>

                    @if ($errors->has('nama_barang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_barang') }}</strong>
                        </span>
                    @endif
                </div> 
            </td>
            <td>
                <div class="{{ $errors->has('keluhan') ? ' has-error' : '' }}">
                    <input id="keluhan" type="text" class="" name="visualresult[{{ $a }}][keluhan]" value="{{ $t->keluhan or old('keluhan') }}" disabled>

                    @if ($errors->has('keluhan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keluhan') }}</strong>
                        </span>
                    @endif
                </div> 
            </td>
            <td>
                <div class="{{ $errors->has('keterangan_visual') ? ' has-error' : '' }}">
                    <textarea name="visualresult[{{ $a }}][keterangan_visual]">{{ old('keterangan_visual') }}</textarea>

                    @if ($errors->has('keterangan_visual'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keterangan_visual') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <input type="file" name="visualresult[{{ $a }}][foto_tabung_visual][]" multiple>
                <input type="hidden"  name="visualresult[{{ $a }}][itemujiriksa_id]" value="{{ $t->id  }}">
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