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

<table class="table">
    <thead>
        <tr>
            <th>Foto Tabung Hasil Service</th>
            <th>Keterangan</th>
            <th><a class="btn btn-default" id='add_field_button'>Tambah Kolom</a></th>
        </tr>
    </thead>
    <tbody id='input_fields_wrap'>
        <tr>
            <td>
                <input id="foto_tabung_service" type="file" class="form-control" name="foto_tabung_service[]" value="{{ old('foto_tabung_service[]') }}">
            </td>                
            <td>
                <textarea id="keterangan_service" type="text" class="form-control" name="keterangan_service[]" value="{{ old('keterangan_service[]') }}"></textarea>
            </td>
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

@section('scripts')
<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr>\
            <td>\
                <input id="foto_tabung_service" type="file" class="form-control" name="foto_tabung_service[' + x +']" value="{{ old('foto_tabung_service[]') }}">\
            </td>\
            <td>\
                <textarea id="keterangan_service" type="text" class="form-control" name="keterangan_service[' + x +']" value="{{ old('keterangan_service[]') }}"></textarea>\
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