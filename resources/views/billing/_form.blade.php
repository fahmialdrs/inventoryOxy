<div class="form-group{{ $errors->has('tanggal_invoice') ? ' has-error' : '' }}">
    <label for="tanggal_invoice" class="col-md-2 control-label">Tanggal Invoice</label>

    <div class="col-md-4">
        <input id="tanggal_invoice" type="date" class="form-control" name="tanggal_invoice" value="{{ old('tanggal_invoice') }}" required autofocus>

        @if ($errors->has('tanggal_invoice'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_invoice') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Customer', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), null, ['class' => 'js-selectize form-control', 'placeholder' => 'Pilih Nama Customer']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    <label for="alamat" class="col-md-2 control-label">Alamat</label>

    <div class="col-md-4">
        <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required>

        @if ($errors->has('alamat'))
            <span class="help-block">
                <strong>{{ $errors->first('alamat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">E-mail</label>

    <div class="col-md-4">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('perihal') ? ' has-error' : '' }}">
    <label for="perihal" class="col-md-2 control-label">Perihal</label>

    <div class="col-md-4">
        <input id="perihal" type="text" class="form-control" name="perihal" value="{{ old('perihal') }}" required>

        @if ($errors->has('perihal'))
            <span class="help-block">
                <strong>{{ $errors->first('perihal') }}</strong>
            </span>
        @endif
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Qty</th>
            <th>Deskripsi</th>
            <th>Unit Price</th>
            <th>Amount</th>
            <th><a class="btn btn-default" id='add_field_button'>Tambah Kolom</a></th>
        </tr>
    </thead>
    <tbody id='input_fields_wrap'>
        <tr>
            <td>
                <input id="qty" type="number" value="{{ old('itembiling[0][quantity]') }}" name="itembiling[0][quantity]" required>
            </td>                
            <td>
                <textarea id="des" type="text" value="{{ old('itembiling[0][deskripsi]') }}" name="itembiling[0][deskripsi]" required></textarea>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">Rp.</div>
                    <input id="upr" type="number" value="{{ old('itembiling[0][unitprice]') }}" name="itembiling[0][unitprice]" required>
                </div>                
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">Rp.</div>
                    <input id="amnt" type="number" value="{{ old('itembiling[0][amount]') }}" name="itembiling[0][amount]" required>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="form-group{{ $errors->has('subtotal') ? ' has-error' : '' }}">
    <label for="subtotal" class="col-md-2 control-label">Subtotal</label>

    <div class="col-md-4">
        <input id="subtotal" type="number" class="form-control" name="subtotal" value="0">

        @if ($errors->has('subtotal'))
            <span class="help-block">
                <strong>{{ $errors->first('subtotal') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('ongkir') ? ' has-error' : '' }}">
    <label for="ongkir" class="col-md-2 control-label">Ongkir</label>

    <div class="col-md-4">
        <input id="ongkir" type="text" class="form-control" name="ongkir" value="0">

        @if ($errors->has('ongkir'))
            <span class="help-block">
                <strong>{{ $errors->first('ongkir') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
    <label for="discount" class="col-md-2 control-label">Discount</label>

    <div class="col-md-4">
        <input id="discount" type="text" class="form-control" name="discount" value="0">
        
        @if ($errors->has('discount'))
            <span class="help-block">
                <strong>{{ $errors->first('discount') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
    <label for="total" class="col-md-2 control-label">Total</label>

    <div class="col-md-4">
        <input id="total" type="text" class="form-control" name="total" required>

        @if ($errors->has('total'))
            <span class="help-block">
                <strong>{{ $errors->first('total') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('terbilang') ? ' has-error' : '' }}">
    <label for="terbilang" class="col-md-2 control-label">Terbilang</label>

    <div class="col-md-4">
        <input id="terbilang" type="text" class="form-control" name="terbilang" value="{{ old('terbilang') }}"required>

        @if ($errors->has('terbilang'))
            <span class="help-block">
                <strong>{{ $errors->first('terbilang') }}</strong>
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
                <input type="number" value="{{ old('itembiling[][quantity]') }}" name="itembiling[' + x +'][quantity]">\
            </td>\
            <td>\
                <textarea type="text" value="{{ old('itembiling[][deskripsi]') }}" name="itembiling[' + x +'][deskripsi]" required></textarea>\
            </td>\
            <td>\
                <div class="input-group">\
                    <div class="input-group-addon">Rp.</div>\
                    <input type="number" value="{{ old('itembiling[][unitprice]') }}" name="itembiling[' + x +'][unitprice]" required>\
                </div>\
            </td>\
            <td>\
                <div class="input-group">\
                    <div class="input-group-addon">Rp.</div>\
                    <input type="number" value="{{ old('itembiling[][amount]') }}" name="itembiling[' + x +'][amount]" required>\
                </div>\
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