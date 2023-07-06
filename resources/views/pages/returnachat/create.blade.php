@extends('layouts.master')
@section('title', 'Gestion Retour Achat')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }

    </style>
@endsection
@section('title_toolbar', 'Nouveau Retour Achats')
@section('subtitle_toolbar', 'Gestion des Retour Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('retournachats.store') }}" id="returnpurchaseform">
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
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Fournisseur</label>
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-10 col-10">
                                            <select class="js-example-basic-single select2" name="suppliers_id">
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <th>Qte</th>
                                            <th>Prix Achat </th>
                                            <th>Sous Total </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="productimgname">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-10 col-sm-10 col-10">
                                                            <select class="js-example-basic-single select2 form-control ProductName products_id" id="element" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                                <option selected="true" disabled="true">Choisir Produit</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
                                                                        {{ $product->name_product }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="qty_line_return_purchase[]" class="form-control qty_line_return_purchase"  @error("qty_line_return_purchase") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_return_purchase[]" class="form-control price_return_purchase"  @error("price_return_purchase") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control subtotal_return_purchase" name="subtotal_return_purchase[]" @error("subtotal_return_purchase") is-invalid @enderror readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                        alt="svg"></a>
                                            </td>
                                        </tr>
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
                                            <input type="number" class="form-control total_return_purchase" name="total_return_purchase" @error("total_return_purchase") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_return_purchase"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{route('retournachats.index')}}" class="btn btn-cancel">Cancel</a>
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
        $("#returnpurchaseform").validate({
             ignore: [],
            rules: {
                // total_purchase_order: {
                //     required: true,
                //     digits: true
                // },
                suppliers_id: "required",
                "products_id[]": {
                    required: true,
                },
                "qty_line_return_purchase[]": {
                    required: true,
                    digits: true
                },
                "price_return_purchase[]": {
                    required: true,
                    digits: true
                },
                // "subtotal_line_purchase_order[]": {
                //     required: true,
                //     digits: true
                // },

            },
            messages: {
                // total_purchase_order: {
                //     required: "Total is required",
                //     digits: "Total is must numeric"
                // },
                suppliers_id: {
                    required: "Supplier is required"
                },
                "qty_line_return_purchase[]":{
                    required: "Qty is required",
                    digits: "Qty is must numeric"
                },
                "price_return_purchase[]":{
                    required: "Price is required",
                    digits: "Price is must numeric"
                },
                // "subtotal_line_purchase_order[]":{
                //     required: "Sous Total is required",
                //     digits: "Sous Total is must numeric"
                // },

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

        $('tbody').delegate('.ProductName', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            tr.find('.qty_line_return_purchase').focus();
        });

        function totalAchat() {
            var totalAchat =0;
            $('.subtotal_return_purchase').each(function(i, e){
                var soustotal = $(this).val() - 0;
                totalRetourAchat += soustotal;
            })
            $('.total_return_purchase').val(totalRetourAchat);
        }
        $('tbody').delegate('.products_id ', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            var prixRetourachat=tr.find('.products_id option:selected').attr('data-price_line_purchase_order');
            tr.find('.price_return_purchase').val(prixRetourachat);
            var qty = tr.find('.qty_line_return_purchase').val()-0;
            var prixRetourachat = tr.find('.price_return_purchase').val()-0;
            var soustotal = qty * prixRetourachat;
            tr.find('.subtotal_return_purchase').val(soustotal);
            totalAchat();
        });
        $('tbody').delegate('.qty_line_return_purchase,.price_return_purchase','change',function(){
            var tr = $(this).parent().parent().parent().parent();
            var qty = tr.find('.qty_line_return_purchase').val()-0;
            var prixRetourachat = tr.find('.price_return_purchase').val()-0;
            var soustotal = qty * prixRetourachat;
            tr.find('.subtotal_return_purchase').val(soustotal);
            totalAchat();
        });


        $('.addline').on('click', function() {

            addline()
        });

        function addline() {
            var addline = `<tr>
                                            <td class="productimgname">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-10 col-sm-10 col-10">
                                                            <select class="js-example-basic-single select2 form-control ProductName products_id" name="products_id[]" id="element" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                                <option selected="selected">-----</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
                                                                        {{ $product->name_product }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="qty_line_return_purchase[]" id="qty" class="form-control qty_line_return_purchase"  @error("qty_line_return_purchase") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_return_purchase[]" id="price" class="form-control price_return_purchase"  @error("price_return_purchase") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control subtotal_return_purchase" id="subtotal" name="subtotal_return_purchase[]" @error("subtotal_return_purchase") is-invalid @enderror readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                        alt="svg"></a>
                                            </td>
                                        </tr>`
            $('tbody').append(addline);
            var newSelectId = 'select' + Date.now();
            var i = 1
            //select 2
            $('#element').attr('id', newSelectId).select2({tags: true});
            $('#qty').attr('id', i++);
            $('#price').attr('id', i++);
            $('#subtotal').attr('id', i++);
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

