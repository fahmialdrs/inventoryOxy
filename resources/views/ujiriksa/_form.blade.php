<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Nama Customer']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<!-- <div class="form-group{{ $errors->has('tube_id') ? ' has-error' : '' }}">
    {!! Form::label('tube_id', 'No Tabung', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('tube_id', [''=>'']+App\Models\Tube::pluck('no_tabung','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih No Tabung']) !!}
        {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div> -->

<!-- <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    <label for="alamat" class="col-md-4 control-label">Alamat</label>

    <div class="col-md-4">
        <textarea id="alamat" type="text" class="form-control" name="alamat" required></textarea>

        @if ($errors->has('alamat'))
            <span class="help-block">
                <strong>{{ $errors->first('alamat') }}</strong>
            </span>
        @endif
    </div>
</div> -->


<div class="form-group{{ $errors->has('jenis_uji') ? ' has-error' : '' }}">
    <label for="jenis_uji" class="col-md-4 control-label">Jenis Uji</label>

    <div class="col-md-4">
    	<label class="radio-inline">
        	<input id="jenis_uji" type="radio" name="jenis_uji" value="Hydrostatic" checked> Hydrostatic
		</label>
		<label class="radio-inline">
        	<input id="jenis_uji" type="radio" name="jenis_uji" value="Visualstatic"> Visualstatic
		</label>
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Service"> Service
        </label>
        @if ($errors->has('jenis_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('jenis_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<!-- <div class="form-group{{ $errors->has('kondisi_tabung') ? ' has-error' : '' }}">
    <label for="kondisi_tabung" class="col-md-4 control-label">Kondisi Tabung</label>

    <div class="col-md-4">
        <input id="kondisi_tabung" type="text" class="form-control" name="kondisi_tabung" required>

        @if ($errors->has('kondisi_tabung'))
            <span class="help-block">
                <strong>{{ $errors->first('kondisi_tabung') }}</strong>
            </span>
        @endif
    </div>
</div> -->

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
    <label for="keterangan" class="col-md-4 control-label">Keterangan</label>

    <div class="col-md-4">
        <textarea id="keterangan" type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}" required></textarea>

        @if ($errors->has('keterangan'))
            <span class="help-block">
                <strong>{{ $errors->first('keterangan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('perkiraan_selesai') ? ' has-error' : '' }}">
    <label for="perkiraan_selesai" class="col-md-4 control-label">Tanggal Perkiraan Selesai</label>

    <div class="col-md-4">
        <input id="perkiraan_selesai" type="date" class="form-control" name="perkiraan_selesai" value="{{ old('perkiraan_selesai') }}" required>

        @if ($errors->has('perkiraan_selesai'))
            <span class="help-block">
                <strong>{{ $errors->first('perkiraan_selesai') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('perkiraan_biaya') ? ' has-error' : '' }}">
    <label for="perkiraan_biaya" class="col-md-4 control-label">Perkiraan Biaya</label>

    <div class="col-md-4">
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="perkiraan_biaya" type="number" class="form-control" name="perkiraan_biaya" value="{{ old('perkiraan_biaya') }}" required>
        </div>

        @if ($errors->has('perkiraan_biaya'))
            <span class="help-block">
                <strong>{{ $errors->first('perkiraan_biaya') }}</strong>
            </span>
        @endif
    </div>
</div>



<div class="form-group{{ $errors->has('nama_penyerah') ? ' has-error' : '' }}">
    <label for="nama_penyerah" class="col-md-4 control-label">Nama Yang Menyerahkan</label>

    <div class="col-md-4">
        <input id="nama_penyerah" type="text" class="form-control" name="nama_penyerah" value="{{ old('nama_penyerah') }}" required>

        @if ($errors->has('nama_penyerah'))
            <span class="help-block">
                <strong>{{ $errors->first('nama_penyerah') }}</strong>
            </span>
        @endif
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Jumlah Barang</th>
            <th>Nama Barang</th>
            <th>No Tabung</th>
            <th>Keluhan</th>
            <th>Foto</th>
            <th><a class="btn btn-default" id='add_field_button'>Tambah Kolom</a></th>
        </tr>
    </thead>
    <tbody id='input_fields_wrap'>
        @if(isset($ujiriksas->itemujiriksa))
        @foreach($ujiriksas->itemujiriksas as $i)
        <tr>
            <td>
                <input type="number" class="form-control" value="{{ $i->jumlah_barang or old('itemujiriksa[0][jumlah_barang]') }}" name="itemujiriksa[0][jumlah_barang]">
            </td>                
            <td>
                <input type="text" class="form-control" value="{{ $i->nama_barang or old('itemujiriksa[0][nama_barang]') }}" name="itemujiriksa[0][nama_barang]">
            </td>
            <td>
                {!! Form::select('itemujiriksa[0][tube_id]', [''=>'']+App\Models\Tube::pluck('no_tabung','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih No Tabung']) !!}
            </td>
            <td>
                <input type="text" class="form-control" value="{{ $i->keluhan or old('itemujiriksa[0][keluhan]') }}" name="itemujiriksa[0][keluhan]">
            </td>
            <td>
                <input type="file" class="form-control" value="{{ $i->foto_tabung_masuk or old('fototabung[0][foto_tabung_masuk]') }}" name="fototabung[0][foto_tabung_masuk]">
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td>
                <input type="number" class="form-control" value="{{ old('itemujiriksa[0][jumlah_barang]') }}" name="itemujiriksa[0][jumlah_barang]">
            </td>                
            <td>
                <input type="text" class="form-control" value="{{ old('itemujiriksa[0][nama_barang]') }}" name="itemujiriksa[0][nama_barang]">
            </td>
            <td>
                <select name="itemujiriksa[0][tube_id]" class="js-selectize form-control" placeholder="Pilih No Tabung">
                    <option disabled selected value></option>
                    @foreach($tabungs as $t)
                        <option value={{ $t->id }}> {{ $t->no_tabung }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" class="form-control" value="{{ old('itemujiriksa[0][keluhan]') }}" name="itemujiriksa[0][keluhan]">
            </td>
            <td>
                <input type="file" class="form-control" value="{{ old('itemujiriksa[0][foto_tabung_masuk]') }}" name="foto_tabung_masuk[]" multiple />
            </td>
        </tr>
        @endif
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
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = 0; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr>\
            <td>\
                <input type="number" class="form-control" value="{{ old('jumlah_barang[]') }}" name="itemujiriksa[' + x +'][jumlah_barang]">\
            </td>\
            <td>\
                <input type="text" class="form-control" value="{{ old('nama_barang[]') }}" name="itemujiriksa[' + x +'][nama_barang]">\
            </td>\
            <td>\
                <select name="itemujiriksa[' + x +'][tube_id]" class="js-selectize form-control" placeholder="Pilih No Tabung">\
                    <option disabled selected value></option>\
                    @foreach($tabungs as $t)\
                        <option value={{ $t->id }}> {{ $t->no_tabung }}</option>\
                    @endforeach\
                </select>\
            </td>\
            <td>\
                <input type="text" class="form-control" value="{{ old('keluhan[]') }}" name="itemujiriksa[' + x +'][keluhan]">\
            </td>\
            <td>\
                <input type="file" class="form-control" value="{{ old('foto_tabung_masuk[]') }}" name="fototabung[' + x +'][][foto_tabung_masuk]" multiple>\
            </td>\
            <td><a class="btn btn-danger remove_field">Hapus Kolom</a></td>\
        </tr>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parents("tr").remove(); x--;
    })
});
</script>
@endsection

