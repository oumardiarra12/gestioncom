@extends('layouts.master')
@section('title', 'Gestion Commande Achat')

@section('title_toolbar', 'Edit Commande Achat')
@section('subtitle_toolbar', 'Gestion des Commande Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('commandeachats.update', $purchaseorder->id) }}">
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
                                                <option @if($purchaseorder->suppliers_id ==  $supplier->id || old('suppliers_id') == $supplier->id) selected @endif  value="{{ $supplier->id }}">{{ $supplier->name_supplier }}
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
                                    <option @if($purchaseorder->stats_purchase_order ==  "in progress" || old('stats_purchase_order') == "in progress") selected @endif value="in progress">En Cours</option>
                                    <option @if($purchaseorder->stats_purchase_order ==  "receipt" || old('stats_purchase_order') == "receipt") selected @endif value="receipt">Receptionner</option>
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
                                    @foreach ($lingepurchaseorder as $lingepurchase)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                        <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                            <option selected="selected">-----</option>
                                                            @foreach ($products as $product)
                                                                <option @if($lingepurchase->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_purchase_order="{{$product->price_purchase}}">
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
                                                    <input type="number" value="{{$lingepurchase->qty_line_purchase_order}}" name="qty_line_purchase_order[]" class="form-control qty_line_purchase_order"  @error("qty_line_purchase_order") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->price_line_purchase_order}}" name="price_line_purchase_order[]" class="form-control price_line_purchase_order"  @error("price_line_purchase_order") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->subtotal_line_purchase_order}}" class="form-control subtotal_line_purchase_order" name="subtotal_line_purchase_order[]" @error("subtotal_line_purchase_order") is-invalid @enderror readonly>
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
                                        <input type="number" value="{{$purchaseorder->total_purchase_order}}"class="form-control total_purchase_order" name="total_purchase_order" @error("total_purchase_order") is-invalid @enderror readonly>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description_purchase_order">{{$purchaseorder->description_purchase_order}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('commandeachats.index')}}" class="btn btn-cancel">Cancel</a>
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
            tr.find('.qty_line_purchase_order').focus();
        });

        function totalAchat() {
            var totalAchat =0;
            $('.subtotal_line_purchase_order').each(function(i, e){
                var soustotal = $(this).val() - 0;
                totalAchat += soustotal;
            })
            $('.total_purchase_order').val(totalAchat);
        }
        $('tbody').delegate('.products_id ', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            var prixachat=tr.find('.products_id option:selected').attr('data-price_line_purchase_order');
            tr.find('.price_line_purchase_order').val(prixachat);
            var qty = tr.find('.qty_line_purchase_order').val()-0;
            var prixachat = tr.find('.price_line_purchase_order').val()-0;
            var soustotal = qty * prixachat;
            tr.find('.subtotal_line_purchase_order').val(soustotal);
            totalAchat();
        });
        $('tbody').delegate('.qty_line_purchase_order,.price_line_purchase_order','change',function(){
            var tr = $(this).parent().parent().parent().parent();
            var qty = tr.find('.qty_line_purchase_order').val()-0;
            var prixachat = tr.find('.price_line_purchase_order').val()-0;
            var soustotal = qty * prixachat;
            tr.find('.subtotal_line_purchase_order').val(soustotal);
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
                                                            <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
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
                                                        <input type="number" name="qty_line_purchase_order[]" class="form-control qty_line_purchase_order"  @error("qty_line_purchase_order") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_line_purchase_order[]" class="form-control price_line_purchase_order"  @error("price_line_purchase_order") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control subtotal_line_purchase_order" readonly name="subtotal_line_purchase_order[]" @error("subtotal_line_purchase_order") is-invalid @enderror>
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
