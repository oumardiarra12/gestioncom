@extends('layouts.master')
@section('title', 'Gestion Retour Achat')

@section('title_toolbar', 'Edit Retour Achat')
@section('subtitle_toolbar', 'Gestion des Retour Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('retournachats.update', $returnPurchase->id) }}">
                @method('put')
                @csrf
                @if($errors->any())
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
                                                <option @if($returnPurchase->suppliers_id ==  $supplier->id || old('suppliers_id') == $supplier->id) selected @endif  value="{{ $supplier->id }}">{{ $supplier->name_supplier }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    @foreach ($lignereturnPurchases as $lignereturnPurchase)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                        <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                            <option selected="selected">-----</option>
                                                            @foreach ($products as $product)
                                                                <option @if($lignereturnPurchase->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
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
                                                    <input type="number" value="{{$lignereturnPurchase->qty_line_return_purchase}}" name="qty_line_return_purchase[]" class="form-control qty_line_return_purchase"  @error("qty_line_return_purchase") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereturnPurchase->price_return_purchase}}" name="price_return_purchase[]" class="form-control price_return_purchase"  @error("price_return_purchase") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereturnPurchase->subtotal_return_purchase}}" class="form-control subtotal_return_purchase" name="subtotal_return_purchase[]" @error("subtotal_return_purchase") is-invalid @enderror readonly>
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
                                        <input type="number" value="{{$returnPurchase->total_return_purchase}}" class="form-control total_return_purchase" name="total_return_purchase" @error("total_return_purchase") is-invalid @enderror readonly>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control"  name="description_return_purchase">{{$returnPurchase->description_return_purchase}}</textarea>
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
        $('.products_id').select2({
                placeholder: $(this).data('placeholder'),
            });
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
            var addline = `  <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                        <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                            <option selected="selected">-----</option>
                                                            @foreach ($products as $product)
                                                                <option @if($lignereturnPurchase->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
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
                                                    <input type="number" value="{{$lignereturnPurchase->qty_line_return_purchase}}" name="qty_line_return_purchase[]" class="form-control qty_line_return_purchase"  @error("qty_line_return_purchase") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereturnPurchase->price_return_purchase}}" name="price_return_purchase[]" class="form-control price_return_purchase"  @error("price_return_purchase") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignereturnPurchase->subtotal_return_purchase}}" class="form-control subtotal_return_purchase" name="subtotal_return_purchase[]" @error("subtotal_return_purchase") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                    alt="svg"></a>
                                        </td>
                                    </tr>`
            $('tbody').append(addline);
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
