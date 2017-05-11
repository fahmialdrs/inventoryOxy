<div class="form-group{{ $errors->has('formujiriksa_id') ? ' has-error' : '' }}">
    {!! Form::label('no_registrasi', 'No Registrasi Uji', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('formujiriksa_id', [''=>'']+App\Models\Formujiriksa::pluck('no_registrasi','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih No Registrasi']) !!}
        {!! $errors->first('formujiriksa_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Foto Tabung Hasil Service</th>
            <th>Keterangan</th>
            <th>Amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody id='listItem'>
        <tr data-id="{{$key->id or ''}}">
            <td>
                <div class="form-group{{ $errors->has('foto_tabung_service') ? ' has-error' : '' }}">
                <div class="col-md-4">
                    <input id="foto_tabung_service" type="file" class="form-control" name="foto_tabung_service">
                    @if (isset($uji) && $uji->foto_tabung_masuk)
                    <p>
                        {!! Html::image(asset('img/'.$uji->foto_tabung_masuk), null, ['class'=>'img-rounded img-responsive']) !!}
                    </p>
                    @endif

                    @if ($errors->has('foto_tabung_service'))
                        <span class="help-block">
                            <strong>{{ $errors->first('foto_tabung_service') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            </td>                
            <td>
                <div class="form-group{{ $errors->has('keterangan_service') ? ' has-error' : '' }}">
                <div class="col-md-8">
                    <input id="keterangan_service" type="text" class="form-control" name="keterangan_service" value="{{ old('keterangan_service') }}">

                    @if ($errors->has('keterangan_service'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keterangan_service') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            </td>
            <td><a class="btn btn-default" id='addProductPrice'>Tambah</a></td>
        </tr>
    </tbody>
</table>


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