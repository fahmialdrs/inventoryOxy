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
        <input id="tanggal_uji" type="date" class="form-control" name="tanggal_uji" value="{{ $form->progress_at->format('Y-m-d') }}" >

        @if ($errors->has('tanggal_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<table class="table table-bordered uji">
    <thead>
        <tr>
            <th class="text-center">No</th>
            @if($form->is_service_alat == 0)
            <th class="text-center">No Tabung</th>
            @else
            <th class="text-center">No Alat</th>
            @endif
            <!-- <th class="text-center">Jumlah Barang</th> -->
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Keluhan</th>
            <th class="text-center">Keterangan Hasil Service</th>
            <th class="text-center">Attachment Hasil Service</th>
        </tr>
    </thead>
    <tbody>
        <?php $a = 0; ?>
        @foreach($form->itemujiriksa as $t)
        <tr>
            <td><b> {{ $a+1 }}</b></td>
            @if($form->is_service_alat == 0)            
            <td>
                <div class="{{ $errors->has('tube_id') ? ' has-error' : '' }}">
                    <input id="tube_id" type="text" class="" name="serviceresult[{{ $a }}][tube_id]" value="{{ $t->tube->no_tabung or old('tube_id') }}" disabled>
                    {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}
                </div>
            </td>
            @else
            <td>
                <div class="{{ $errors->has('alat_id') ? ' has-error' : '' }}">
                    <input id="alat_id" type="text" class="" name="serviceresult[{{ $a }}][alat_id]" value="{{ $t->alat->no_alat or old('alat_id') }}" disabled>
                    {!! $errors->first('tube_id', '<p class="help-block">:message</p>') !!}
                </div>
            </td>
            @endif
            <!-- <td>
                <div class="{{ $errors->has('jumlah_barang') ? ' has-error' : '' }}">
                    <input id="jumlah_barang" type="text" class="" name="serviceresult[{{ $a }}][jumlah_barang]" value="{{ $t->jumlah_barang or old('jumlah_barang') }}" disabled>

                    @if ($errors->has('jumlah_barang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('jumlah_barang') }}</strong>
                        </span>
                    @endif
                </div>
            </td> -->
            <td>
                <div class="{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
                    <input id="nama_barang" type="text" class="" name="serviceresult[{{ $a }}][nama_barang]" value="{{ $t->nama_barang or old('nama_barang') }}" disabled>

                    @if ($errors->has('nama_barang'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_barang') }}</strong>
                        </span>
                    @endif
                </div> 
            </td>
            <td>
                <div class="{{ $errors->has('keluhan') ? ' has-error' : '' }}">
                    <input id="keluhan" type="text" class="" name="serviceresult[{{ $a }}][keluhan]" value="{{ $t->keluhan or old('keluhan') }}" disabled>

                    @if ($errors->has('keluhan'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keluhan') }}</strong>
                        </span>
                    @endif
                </div> 
            </td>
            <td>
                <div class="{{ $errors->has('keterangan_service') ? ' has-error' : '' }}">
                    <textarea name="serviceresult[{{ $a }}][keterangan_service]">{{ old('keterangan_service') }}</textarea>

                    @if ($errors->has('keterangan_service'))
                        <span class="help-block">
                            <strong>{{ $errors->first('keterangan_service') }}</strong>
                        </span>
                    @endif
                </div>
            </td>
            <td>
                <label class="radio-inline">
                    <input id="video" class="jenisfile{{ $a }}" type="radio" name="jenisfile{{ $a }}" value="1" checked> Video
                </label>
                <label class="radio-inline">
                    <input id="foto" class="jenisfile{{ $a }}" type="radio" name="jenisfile{{ $a }}" value="0"> Foto
                </label>

                <input type="file" id="inputvideo{{ $a }}" name="serviceresult[{{ $a }}][foto_tabung_service][]">
                <input type="file" id="inputfoto{{ $a }}" name="serviceresult[{{ $a }}][foto_tabung_service][]" multiple style="display:none;">
                <input type="hidden"  name="serviceresult[{{ $a }}][itemujiriksa_id]" value="{{ $t->id  }}">
            </td>
        </tr>
        <?php $a++ ?>
        @endforeach
    </tbody>
</table>


<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-lg btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        <button type="submit" class="btn btn-warning btn-lg">
            Batal
        </button>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {

    $('.uji').find('tr').click( function(){
        var a = $(this).index();

        $('input.jenisfile' + a ).click( function(){
            console.log($(this).val());
            if($(this).val() == 1) {
                $('#inputvideo'+ a).show();
                $('#inputfoto'+ a).hide();
                $('#inputfoto').val('');          
           }

           else {
                $('#inputvideo'+ a).hide();
                $('#inputfoto'+ a).show();
                $('#inputvideo').val('');
           }
       });
    });
});
</script>
@endsection