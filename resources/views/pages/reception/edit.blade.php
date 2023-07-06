@extends('layouts.master')
@section('title', 'Gestion Reception')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }

    </style>
@endsection
@section('title_toolbar', 'Edit Reception')
@section('subtitle_toolbar', 'Gestion des Receptions')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('receptions.update',$reception->id) }}" id="editreceptionform">
                @method('put')
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="select" name="stats_purchase_order">
                                        <option value="in progress">En Cours</option>
                                        <option value="receipt">Receptionner</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-group d-flex flex-row-reverse">
                                    <button type="button" class="btn btn-rounded btn-info addline"><img src="assets/img/icons/plus1.svg" alt="img"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom Produit</th>
                                            <th>Qte CMD</th>
                                            <th>Qte Recept </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($lignereceptions as $lignereception)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror readonly>
                                                        <option selected="selected">-----</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" @if($lignereception->products_id ==  $product->id || old('products_id') == $product->id) selected @endif data-price_line_purchase_order="{{$product->price_purchase}}">
                                                                {{ $product->name_product }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->qty_line_reception}}"  name="qty_line_reception[]" class="form-control qty_line_reception"  @error("qty_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->qty_recu_line_reception}}"  class="form-control qty_recu_line_reception" name="qty_recu_line_reception[]" @error("qty_recu_line_reception") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->price_line_reception}}"  class="form-control price_line_reception" name="price_line_reception[]" @error("price_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->subtotal_line_reception}}"  class="form-control subtotal_line_reception" name="subtotal_line_reception[]" @error("subtotal_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                    alt="svg"></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 float-md-right">
                                <div class="total-order">
                                    <ul>
                                        <li class="total">
                                            <h4>Total</h4>
                                            <input type="number" class="form-control total_reception" value="{{$reception->total_reception}}" name="total_reception" @error("total_reception") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control"  name="description_reception">{{$reception->description_reception}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{route('receptions.index')}}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#editreceptionform").validate({
             ignore: [],
            rules: {
                "qty_recu_line_reception[]": {
                    required: true,
                    digits: true
                },


            },
            messages: {

                "qty_recu_line_reception[]":{
                    required: "Qty is required",
                    digits: "Qty is must numeric"
                },

            },
            // errorPlacement:function(error,element){
            //     if(element.attr("name")=="products_id[]"){
            //         $('#message_error').empty();error.appendTo('#message_error')
            //     }else{
            //         error.insertAfter(element)
            //     }
            // }

        });

    });
</script>
    <script>
    $(document).ready(function() {
        $('.products_id').select2({
                placeholder: $(this).data('placeholder'),
            });
        $('tbody').delegate('.ProductName', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            tr.find('.qty_recu_line_reception').focus();
        });

        function totalAchat() {
            var totalAchat =0;
            $('.subtotal_line_reception').each(function(i, e){
                var soustotal = $(this).val() - 0;
                totalAchat += soustotal;
            })
            $('.total_reception').val(totalAchat);
        }
        $('tbody').delegate('.products_id ', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            var prixachat=tr.find('.products_id option:selected').attr('data-price_line_purchase_order');
            tr.find('.price_line_reception').val(prixachat);
            var qty = tr.find('.qty_recu_line_reception').val()-0;
            var prixachat = tr.find('.price_line_reception').val()-0;
            var soustotal = qty * prixachat;
            tr.find('.subtotal_line_reception').val(soustotal);
            totalAchat();
        });
        $('tbody').delegate('.qty_recu_line_reception,.price_line_reception','change',function(){
            var tr = $(this).parent().parent().parent().parent();
            var qty = tr.find('.qty_recu_line_reception').val()-0;
            var prixachat = tr.find('.price_line_reception').val()-0;
            var soustotal = qty * prixachat;
            tr.find('.subtotal_line_reception').val(soustotal);
            totalAchat();
        });

        $('.addline').on('click', function() {

            addline()
        });

        function addline() {
            var addline = ` <tr>
                                            <td class="productimgname">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-10 col-sm-10 col-10">
                                                            <div class="col-md-10">
                                                                <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror readonly>
                                                                <option selected="selected">-----</option>
                                                                @foreach ($products as $product)
                                                                    <option  @if($lignereception->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
                                                                        {{ $product->name_product }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" value="{{$lignereception->qty_line_reception}}"  name="qty_line_reception[]" class="form-control qty_line_reception"  @error("qty_line_reception") is-invalid @enderror readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" value="{{$lignereception->qty_recu_line_reception}}"  class="form-control qty_recu_line_reception" name="qty_recu_line_reception[]" @error("qty_recu_line_reception") is-invalid @enderror >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->price_line_reception}}" id="price"  class="form-control price_line_reception" name="price_line_reception[]" @error("price_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereception->subtotal_line_reception}}" id="subtotal"  class="form-control subtotal_line_reception" name="subtotal_line_reception[]" @error("subtotal_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                            <td>
                                                <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                        alt="svg"></a>
                                            </td>
                                        </tr>`
            $('tbody').append(addline);
            var i = 1;
            $('#qty').attr('id', i++);
        };

        $('tbody').delegate('.remove','click',function(){
            var l = $('tbody tr').length;
            if (l == 1) {
                 alert('Vous etes sur de Supprimer')
             } else {
                 $(this).parent().parent().remove();
                 totalAchat()
            }
        })
    });
    </script>


    @endsection

