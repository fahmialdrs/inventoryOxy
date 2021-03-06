<div class="form-group{{ $errors->has('tanggal_invoice') ? ' has-error' : '' }}">
    <label for="tanggal_invoice" class="col-md-2 control-label">Tanggal Invoice</label>

    <div class="col-md-4">
    @if(isset($billings->tanggal_invoice))
        <input id="tanggal_invoice" type="date" class="form-control" name="tanggal_invoice" value="{{ $billings->tanggal_invoice or old('tanggal_invoice') }}" required>
    @else
        <input id="tanggal_invoice" type="date" class="form-control" name="tanggal_invoice" value="{{ date('Y-m-d') }}" required>
    @endif
        @if ($errors->has('tanggal_invoice'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal_invoice') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('formujiriksa_id') ? ' has-error' : '' }}">
    {!! Form::label('formujiriksa_id', 'No Registrasi', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('formujiriksa_id', [''=>'']+App\Models\Formujiriksa::pluck('no_registrasi','id')->all(), $form->id, ['class' => 'js-selectize form-control select2', 'id' => 'no_registrasi', 'placeholder' => 'Pilih No Registrasi']) !!}
        {!! $errors->first('formujiriksa_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('customer_id') ? ' has-error' : '' }}">
    {!! Form::label('customer_id', 'Nama Customer', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('customer_id', [''=>'']+App\Models\Customer::pluck('nama','id')->all(), $form->customer->id, ['class' => 'js-selectize form-control select2', 'id' => 'customer', 'placeholder' => 'Pilih Nama Customer']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}     
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    <label for="alamat" class="col-md-2 control-label">Alamat</label>

    <div class="col-md-4">
    @if(isset($billings->customer_id))
        <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $billings->customer->alamat or old('alamat') }}" read only required>
    @else
       <input id="alamat" type="text" class="form-control" name="alamat" value="{{ $form->customer->alamat or old('alamat') }}" readonly required> 
    @endif
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
    @if(isset($billings->customer_id))
        <input id="email" type="email" class="form-control" name="email" value="{{ $billings->customer->email or old('email') }}" required>
    @else
        <input id="email" type="email" class="form-control" name="email" value="{{ $form->customer->email or old('email') }}" required>
    @endif

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
    @if(isset($billings->perihal))
        <input id="perihal" type="text" class="form-control" name="perihal" value="{{ $billings->perihal or old('perihal') }}" required>
    @else
        <input id="perihal" type="text" class="form-control" name="perihal" value="{{ $form->keterangan or old('perihal') }}" required>
    @endif
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
        <?php $a=0; ?>
        @foreach($form->itemujiriksa as $i) 
        <tr class="bill">
            <td>
                <input id="qty-{{$a}}" class="form-control qty" type="number" value="{{ 1 }}" name="itembiling[{{$a}}][quantity]" required>
            </td>                
            <td>
                <textarea id="des" type="text" class="form-control" name="itembiling[{{$a}}][deskripsi]" required>{{ $i->nama_barang }} - {{ $i->keluhan }}</textarea>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">Rp.</div>
                    <input id="upr-{{$a}}" class="form-control upr" type="number" value="{{ 0 }}" name="itembiling[{{$a}}][unitprice]" onblur="calculate()" required>
                </div>                
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-addon">Rp.</div>
                    <input id="amnt-{{$a}}" class="form-control amnt" type="number" value="{{ 0 }}" name="itembiling[{{$a}}][amount]" readonly required>
                </div>
            </td>
        </tr>
        <?php $a++; ?>
        @endforeach
    </tbody>
</table>

<div class="form-group{{ $errors->has('subtotal') ? ' has-error' : '' }}">
    <label for="subtotal" class="col-md-2 control-label">Subtotal</label>

    <div class="col-md-4">
    @if(isset($billings->subtotal))
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="subtotal" type="number" class="form-control" name="subtotal" value="{{ $billings->subtotal }}" readonly>
        </div>
    @else
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="subtotal" type="number" class="form-control" name="subtotal" value="{{ old('subtotal') ?? '0' }}" readonly>
        </div>
    @endif
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
    @if(isset($billings->ongkir))
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="ongkir" type="number" class="form-control" name="ongkir" value="{{ $billings->ongkir ?? '0' }}" onblur="grandtotal()">
        </div>        
    @else
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="ongkir" type="number" class="form-control" name="ongkir" value="{{ old('ongkir') ?? '0' }}" onblur="grandtotal()">
        </div>
    @endif
    </div>
        @if ($errors->has('ongkir'))
            <span class="help-block">
                <strong>{{ $errors->first('ongkir') }}</strong>
            </span>
        @endif
    </div>

<div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
    <label for="discount" class="col-md-2 control-label">Discount</label>

    <div class="col-md-4">
    @if(isset($billings->discount))
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="discount" type="number" class="form-control" name="discount" value="{{ $billings->discount ?? '0' }}" onblur="grandtotal()">
        </div>
    @else
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="discount" type="number" class="form-control" name="discount" value="{{ old('discount') ?? '0' }}" onblur="grandtotal()">
        </div>
    @endif
        @if ($errors->has('discount'))
            <span class="help-block">
                <strong>{{ $errors->first('discount') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('ppn') ? ' has-error' : '' }}">
    <label for="ppn" class="col-md-2 control-label">PPN</label>

    <div class="col-md-4">
    @if(isset($billings->ppn))
        <div class="input-group">
            <input id="ppn" type="number" class="form-control" name="ppn" value="{{ $billings->ppn ?? '0' }}" onblur="grandtotal()">
            <div class="input-group-addon">%</div>
        </div>
    @else
        <div class="input-group">
            <input id="ppn" type="number" class="form-control" name="ppn" value="{{ old('ppn') ?? '0' }}" onblur="grandtotal()">
            <div class="input-group-addon">%</div>
        </div>
    @endif
        @if ($errors->has('ppn'))
            <span class="help-block">
                <strong>{{ $errors->first('ppn') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
    <label for="total" class="col-md-2 control-label">Total</label>

    <div class="col-md-4">
    @if(isset($billings->total))
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="total" type="text" class="form-control" name="total" value="{{ $billings->total ?? '0' }}" readonly>
        </div>
    @else
        <div class="input-group">
            <div class="input-group-addon">Rp.</div>
            <input id="total" type="text" class="form-control" name="total" value="{{ old('total') ?? '0' }}"readonly>
        </div>
    @endif
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
    @if(isset($billings->terbilang))
        <input id="terbilang" type="text" class="form-control" name="terbilang" value="{{ $billings->terbilang or old('terbilang') }}"required>
    @else
        <input id="terbilang" type="text" class="form-control" name="terbilang" value="{{ old('terbilang') }}"required>
    @endif
        @if ($errors->has('terbilang'))
            <span class="help-block">
                <strong>{{ $errors->first('terbilang') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
    <label for="catatan" class="col-md-2 control-label">Catatan</label>

    <div class="col-md-4">
    @if(isset($billings->catatan))
        <textarea class="form-control" name="catatan" id="catatan">{{ $billings->catatan }}</textarea>
    @else
        <textarea class="form-control" name="catatan" id="catatan">{{ old('catatan') }}</textarea>
    @endif
        @if ($errors->has('catatan'))
            <span class="help-block">
                <strong>{{ $errors->first('catatan') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-4">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Data Sudah Benar?')">
        <!-- <i class="fa fa-btn fa-user"></i> -->
            Simpan
        </button>
        @if(request()->route()->getName() != "billing.edit")
        <button type="submit" name="new" class="btn btn-success" onclick="return confirm('Apakah Data Sudah Benar?')">
            Simpan & Buat Baru
        </button>
        @endif
        <a href="{{ route('billing.index') }}" class="btn btn-warning">
            Batal
        </a>
    </div>
</div>



@section('scripts')
<script>
    $("#alat"+index).change(function(){
    var count = $('.item').length;
    
    for (index; index < count; index++) {
        
        var alat =$("#alat"+index).val();
        console.log(alat);
        var urls = "/admin/getDataJenis/alat/"+alat;
        console.log(urls);
        $.ajax({
        type:"get",
        url: urls,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
        success:function(data){
            console.log(data);
            var json = data,
            obj = json;
              $("#nama_barang" +(index) ).val(obj.jenisalat.nama_alat);
        }
         });

    }
   });
no++;
</script>

<script>
$(document).ready(function(){
   $("#customer").change(function(){
     var customer =$("#customer").val();
     $.ajax({
    type:"get",
    url:"/admin/getDataCustomer/billing/"+customer,
    data: function (params) {
      return {
        q: params.term, // search term
        page: params.page
      };
      console.log(url);      
    },
    success:function(data){
        console.log(data);
        var json = data,
        obj = json;
          $("#alamat").val(obj.alamat);
          $('#email').val(obj.email);
    }
     });
   });
});
</script>

<script>
    $(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
    var wrapper         = $("#input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = {{$a}}; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            
            $(wrapper).append('<tr class="bill">\
            <td>\
                <input id="qty-' + x +'" class="form-control qty" type="number" value="{{ old('itembiling[][quantity]') }}" name="itembiling[' + x +'][quantity]">\
            </td>\
            <td>\
                <textarea type="text" class="form-control" value="{{ old('itembiling[][deskripsi]') }}" name="itembiling[' + x +'][deskripsi]" required></textarea>\
            </td>\
            <td>\
                <div class="input-group">\
                    <div class="input-group-addon">Rp.</div>\
                    <input id="upr-' + x +'" class="form-control upr" type="number" value="{{ old('itembiling[][unitprice]') }}" name="itembiling[' + x +'][unitprice]" onblur="calculate()" required>\
                </div>\
            </td>\
            <td>\
                <div class="input-group">\
                    <div class="input-group-addon">Rp.</div>\
                    <input id="amnt-' + x +'" class="form-control amnt" type="number" value="{{ old('itembiling[][amount]') }}" name="itembiling[' + x +'][amount]" readonly>\
                </div>\
            </td>\
            <td><a class="btn btn-danger remove_field" onclick="calculate()">Hapus Kolom</a></td>\
        </tr>'); //add input box
            x++; //text box increment
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parents("tr").remove();
        $('#amnt-'+x).val(0);
        x--;

    })
});
</script>
<script type="text/javascript">
    // hitung amount
    calculate = function()
    {   
        var count = $('.bill').length;
        // console.log($(count));
        var subs = 0;
        
        for (var index = 0; index < count; index++) {
            
            var qty = $('#qty-'+index).val();
            var upr = $('#upr-'+index).val();
            var jumlah = qty * upr;
            $('#amnt-'+index).val(jumlah);

            var amnt = $('#amnt-'+index).val();
            subs = parseInt(subs) + parseInt(amnt);
            $('#subtotal').val(subs);

        }
    }

    // hitung total keseluruhan
    grandtotal = function()
    {   
        var subtotal = $('#subtotal').val();
        var discount = $('#discount').val();
        var ppn = $('#ppn').val();
        var ongkir = $('#ongkir').val();
        var total;
        var disc;
        var totalsementara;
        var totalppn;        

        total = (parseInt(subtotal) + parseInt(ongkir));
        totalsementara = (parseInt(total) - parseInt(discount));
        console.log(discount);
        totalppn = (parseInt(totalsementara) * (parseInt(ppn) / 100));
        $('#total').val(parseInt(totalsementara) + parseInt(totalppn));
    }

</script>
@endsection