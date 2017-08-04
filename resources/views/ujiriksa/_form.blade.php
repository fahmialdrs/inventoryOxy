<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Pemilik', ['class'=>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'id' => 'customer', 'placeholder' => 'Pilih Nama Customer']) !!}
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
    @if(isset($ujiriksas->jenis_uji))
        @if($ujiriksas->jenis_uji == "Hydrostatic")
    	<label class="radio-inline">
        	<input id="jenis_uji" type="radio" name="jenis_uji" value="Hydrostatic" checked> Hydrostatic
		</label>
		<label class="radio-inline">
        	<input id="jenis_uji" type="radio" name="jenis_uji" value="Visualstatic"> Visualstatic
		</label>
        <label class="radio-inline">
            <input id="service" type="radio" name="jenis_uji" value="Service"> Service
        </label>
        @elseif($ujiriksas->jenis_uji == "Visualstatic")
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Hydrostatic"> Hydrostatic
        </label>
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Visualstatic" checked> Visualstatic
        </label>
        <label class="radio-inline">
            <input id="service" type="radio" name="jenis_uji" value="Service"> Service
        </label>
        @elseif($ujiriksas->jenis_uji == "Service")
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Hydrostatic"> Hydrostatic
        </label>
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Visualstatic"> Visualstatic
        </label>
        <label class="radio-inline">
            <input id="service" type="radio" name="jenis_uji" value="Service" checked> Service
        </label>
        @endif
    @else
        <label class="radio-inline">
            <input id="hydrostatic" type="radio" name="jenis_uji" value="Hydrostatic" checked> Hydrostatic
        </label>
        <label class="radio-inline">
            <input id="jenis_uji" type="radio" name="jenis_uji" value="Visualstatic"> Visualstatic
        </label>
        <label class="radio-inline">
            <input id="service" type="radio" name="jenis_uji" value="Service"> Service
        </label>

    @endif

        @if ($errors->has('jenis_uji'))
            <span class="help-block">
                <strong>{{ $errors->first('jenis_uji') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group" id="radio_hydro">
    <label for="radio_hydro" class="col-md-4 control-label">Visualstatic Test</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="ya" type="radio" name="is_visual" value="1" > Ya
        </label>
        <label class="radio-inline">
            <input id="tidak" type="radio" name="is_visual" value="0" checked> Tidak
        </label>
    </div>
</div>

@if(isset($ujiriksas->is_service_alat))
@if($ujiriksas->is_service_alat == 1)

<div class="form-group" id="radio_service">
    <label for="jenis_uji" class="col-md-4 control-label">Jenis Service</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="tabung" type="radio" name="is_service_alat" value="0" > Tabung
        </label>
        <label class="radio-inline">
            <input id="alat" type="radio" name="is_service_alat" value="1" checked> Alat
        </label>
    </div>
</div>

@else
<div class="form-group" id="radio_service">
    <label for="jenis_uji" class="col-md-4 control-label">Jenis Service</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="tabung" type="radio" name="is_service_alat" value="0" checked> Tabung
        </label>
        <label class="radio-inline">
            <input id="alat" type="radio" name="is_service_alat" value="1"> Alat
        </label>
    </div>
</div>
@endif
@else
<div class="form-group" id="radio_service" style="display:none;">
    <label for="jenis_uji" class="col-md-4 control-label">Jenis Service</label>

    <div class="col-md-4">
        <label class="radio-inline">
            <input id="tabung" type="radio" name="is_service_alat" value="0" checked> Tabung
        </label>
        <label class="radio-inline">
            <input id="alat" type="radio" name="is_service_alat" value="1"> Alat
        </label>
    </div>
</div>
@endif

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
        @if(isset($ujiriksas->keterangan))
        <textarea id="keterangan" type="text" class="form-control" name="keterangan" required>{{ $ujiriksas->keterangan }}</textarea>
        @else
        <textarea id="keterangan" type="text" class="form-control" name="keterangan" required>{{ old('keterangan') }}</textarea>
        @endif

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
        @if(isset($ujiriksas->perkiraan_selesai))
        <input id="perkiraan_selesai" type="date" class="form-control" name="perkiraan_selesai" value="{{ $ujiriksas->perkiraan_selesai }}" required>
        @else
        <input id="perkiraan_selesai" type="date" class="form-control" name="perkiraan_selesai" value="{{ old('perkiraan_selesai') }}" required>
        @endif

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
            @if(isset($ujiriksas->perkiraan_biaya))
            <input id="perkiraan_biaya" class="form-control number" name="perkiraan_biaya" value="{{ $ujiriksas->perkiraan_biaya }}" required>
            @else
            <input id="perkiraan_biaya" class="form-control number" name="perkiraan_biaya" value="{{ old('perkiraan_biaya') }}" required>
            @endif
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
        @if(isset($ujiriksas->nama_penyerah))
        <input id="nama_penyerah" type="text" class="form-control" name="nama_penyerah" value="{{ $ujiriksas->nama_penyerah }}" required>
        @else
        <input id="nama_penyerah" type="text" class="form-control" name="nama_penyerah" value="{{ old('nama_penyerah') }}" required>
        @endif
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
            @if (isset($ujiriksas->is_service_alat))
            @if ($ujiriksas->is_service_alat == 0)
            <th class="form_tabung">No Tabung</th>
            @else
            <th class="form_alat">No Alat</th>
            @endif
            @else
            <th class="form_tabung">No Tabung</th>
            <th class="form_alat" style="display:none">No Alat</th>
            @endif
            <th>Keluhan</th>
            <th>Foto</th>
            <th><a class="btn btn-default" id='add_field_button'>Tambah Kolom</a></th>
        </tr>
    </thead>
    <tbody id='input_fields_wrap'>
        @if(isset($ujiriksas->itemujiriksa))
        <?php $a=0; ?>
        @foreach($ujiriksas->itemujiriksa as $i)
        <tr>
            <td>
                <input type="number" class="form-control" min="0" value="{{ $i->jumlah_barang }}" name="itemujiriksa[{{$a}}][jumlah_barang]" required>
            </td>                
            <td>
                <input type="text" class="form-control" value="{{ $i->nama_barang }}" name="itemujiriksa[{{$a}}][nama_barang]" required>
            </td>
            @if ($ujiriksas->is_service_alat == 0)
            <td class="form_tabung">
                <select name="itemujiriksa[{{$a}}][tube_id]" class="js-selectize form-control" placeholder="Pilih No Tabung" >
                    <option disabled selected value></option>
                    @foreach($ujiriksas->itemujiriksa as $t)
                        <option value="{{ $t->tube->id }}">{{ $t->tube->no_tabung }}</option>
                    @endforeach
                </select>
            </td>
            @else
            <td class="form_alat">
                <select name="itemujiriksa[{{$a}}][alat_id]" class="js-selectize form-control" placeholder="Pilih No Alat" >
                    <option disabled selected value></option>
                    @foreach($ujiriksas->itemujiriksa as $t)
                        <option value="{{ $t->alat->id }}">{{ $t->alat->no_alat }}</option>
                    @endforeach
                </select>
            </td>
            @endif
            <td>
                <input type="text" class="form-control" value="{{ $i->keluhan }}" name="itemujiriksa[{{$a}}][keluhan]" required>
            </td>
            <td>
                <input type="file" class="form-control" value="{{ $i->foto_tabung_masuk }}" name="itemujiriksa[{{$a}}][fototabung][]" multiple>
                <span>
                    @foreach($i->fototabung as $foto)                     
                        <img src="{{ asset('storage/foto/'.$foto->foto_tabung_masuk) }}" class="img-rounded" width="100" height="75">                    
                   @endforeach
                </span>
            </td>
            <td><a class="btn btn-danger remove_field">Hapus Kolom</a></td>
        </tr>
        <?php $a++; ?>
        @endforeach
        @else
        <?php $a=0; ?>
        <tr>
            <td>
                <input type="number" class="form-control" value="{{ old('itemujiriksa[0][jumlah_barang]') }}" name="itemujiriksa[0][jumlah_barang]" required>
            </td>                
            <td>
                <input type="text" class="form-control" value="{{ old('itemujiriksa[0][nama_barang]') }}" name="itemujiriksa[0][nama_barang]" required>
            </td>
            <td class="form_tabung">
                <select name="itemujiriksa[0][tube_id]" class="form-control tube" style="width: 100%">
                </select>
            </td>
            <td class="form_alat" style="display:none">
                <select name="itemujiriksa[0][alat_id]" class="form-control alat" style="width: 100%">
                </select>
            </td>
            <td>
                <input type="text" class="form-control" value="{{ old('itemujiriksa[0][keluhan]') }}" name="itemujiriksa[0][keluhan]" required>
            </td>
            <td>
                <input type="file" class="form-control" value="{{ old('itemujiriksa[0][fototabung][]') }}" name="itemujiriksa[0][fototabung][]" multiple />
            </td>
        </tr>
        <?php $a++; ?>
        @endif
    </tbody>
</table>



<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "ujiriksa.edit")
        <button type="submit" name="new" class="btn btn-success" onclick="return confirm('Apakah Data Sudah Benar?')">
            Simpan & Buat Baru
        </button>
        @endif
        <button type="reset" class="btn btn-warning">
            Batal
        </button>
    </div>
</div>

@section('scripts')
<script>
    $('input.number').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  var $select2Elm = $('.tube');
    $select2Elm.select2({
            width: 'resolve',
            placeholder: "Pilih No Tabung",
            ajax: {
                url: function(){
                    var value = $('#customer').val();
                    var url = "/admin/getDataTabung/ujiriksa/"+value;
                    console.log(url);
                    return url;
                },
                dataType: 'json',
                type: "GET",
                delay: 20,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, page) {
                  // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data
                  return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                  };
                },
                cache: true
              },
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  var $select2Elm = $('.alat');
    $select2Elm.select2({
            width: 'resolve',
            placeholder: "Pilih No Alat",
            ajax: {
                url: function(){
                    var value = $('#customer').val();
                    var url = "/admin/getDataAlat/ujiriksa/"+value;
                    console.log(url);
                    return url;
                },
                dataType: 'json',
                type: "GET",
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, page) {
                  // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data
                  return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                  };
                },
                cache: true
              },
    });
});
</script>
<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = {{$a}}; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            $(wrapper).append('<tr>\
            <td>\
                <input type="number" class="form-control" value="{{ old('jumlah_barang[]') }}" name="itemujiriksa[' + x +'][jumlah_barang]" required>\
            </td>\
            <td>\
                <input type="text" class="form-control" value="{{ old('nama_barang[]') }}" name="itemujiriksa[' + x +'][nama_barang]" required>\
            </td>\
            <td class="form_tabung">\
                <select name="itemujiriksa[' + x +'][tube_id]" class="form-control tube" style="width: 100%">\
                </select>\
            </td>\
            <td class="form_alat" style="display:none">\
                <select name="itemujiriksa[' + x +'][alat_id]" class="form-control alat" style="width: 100%">\
                </select>\
            </td>\
            <td>\
                <input type="text" class="form-control" value="{{ old('keluhan[]') }}" name="itemujiriksa[' + x +'][keluhan]" required>\
            </td>\
            <td>\
                <input type="file" class="form-control" value="{{ old("itemujiriksa['+ x +'][fototabung][]") }}" name="itemujiriksa[' + x +'][fototabung][]" multiple>\
            </td>\
            <td><a class="btn btn-danger remove_field">Hapus Kolom</a></td>\
        </tr>'); //add input box
            x++; //text box increment
        }

    $('.tube').select2({
            width: 'resolve',
            placeholder: "Pilih No Tabung",
            ajax: {
                url: function(){
                    var value = $('#customer').val();
                    var url = "/admin/getDataTabung/ujiriksa/"+value;
                    console.log(url);
                    return url;
                },
                dataType: 'json',
                type: "GET",
                delay: 20,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, page) {
                  // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data
                  return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                  };
                },
                cache: true
              },
    });

    $('.alat').select2({
            width: 'resolve',
            placeholder: "Pilih No Alat",
            ajax: {
                url: function(){
                    var value = $('#customer').val();
                    var url = "/admin/getDataAlat/ujiriksa/"+value;
                    console.log(url);
                    return url;
                },
                dataType: 'json',
                type: "GET",
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, page) {
                  // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data
                  return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                  };
                },
                cache: true
              },
    });
    console.log($('input[name="is_service_alat"]:checked').val());
    
    if($('input[name="is_service_alat"]:checked').val() == 1) {
        $('.form_alat').show();
        $('.form_tabung').hide();
    }

    else if($('input[name="is_service_alat"]:checked').val() == 0) {
        $('.form_alat').hide();
        $('.form_tabung').show();   
    }
});
    
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parents("tr").remove(); x--;
    })


});
</script>
<script>
$(document).ready(function() {
    $('input[name="jenis_uji"]').click(function() {
       if($(this).attr('id') == 'hydrostatic') {
            $('#radio_hydro').show();           
       }

       else {
            $('#radio_hydro').hide();
            $('#tidak').prop('checked',true); 
       }
   });

   $('input[name="jenis_uji"]').click(function() {
       if($(this).attr('id') == 'service') {
            $('#radio_service').show();           
       }

       else {
            $('#tabung').prop('checked',true);
            $('#radio_service').hide();
            $('.form_alat').hide();
            $('.form_tabung').show();   
       }
   });

   $('input[name="is_service_alat"]').click(function() {
       if($(this).attr('id') == 'alat') {
            $('.form_alat').show();
            $('.form_tabung').hide();
       }
       else {
            $('.form_alat').hide();
            $('.form_tabung').show();   
       }
   });

   
});
</script>
@endsection

