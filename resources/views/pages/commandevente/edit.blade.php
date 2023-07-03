@extends('layouts.master')
@section('title', 'Gestion Commande Vente')

@section('title_toolbar', 'Edit Commande  Vente')
@section('subtitle_toolbar', 'Gestion des Commande  Ventes')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('commandeventes.update', $customerorder->id) }}">
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
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Client</label>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-6">
                                        <select class="js-example-basic-single select2" name="suppliers_id">
                                            @foreach ($customers as $customer)
                                                <option @if($customerorder->customers_id ==  $customer->id || old('customers_id') == $customer->id) selected @endif  value="{{ $customer->id }}">{{ $customer->firstname_customer }} {{ $customer->lastname_customer }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label>Reference</label>
                               <input type="text" class="form-control" name="num_customer_order" value="{{$customerorder->num_customer_order}}" readonly/>
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
                                        <th>PrixVente </th>
                                        <th>Sous Total </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lingecustomerorder as $lingecustomer)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                        <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                            <option selected="selected">-----</option>
                                                            @foreach ($products as $product)
                                                                <option @if($lingecustomer->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}"  data-price_line_customer_order="{{$product->price_sale}}">
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
                                                    <input type="number" value="{{$lingecustomer->qty_line_customer_order}}" value="{{$customerorder->qty_line_customer_order}}" name="qty_line_customer_order[]" class="form-control qty_line_customer_order"  @error("qty_line_customer_order") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->price_line_customer_order}}" value="{{$lingecustomer->price_line_customer_order}}" name="price_line_customer_order[]" class="form-control price_line_customer_order"  @error("price_line_customer_order") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->subtotal_line_customer_order}}" value="{{$lingecustomer->subtotal_line_customer_order}}" class="form-control subtotal_line_customer_order" name="subtotal_line_customer_order[]" @error("subtotal_line_customer_order") is-invalid @enderror readonly>
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
                                        <input type="number" value="{{$customerorder->total_customer_order}}"class="form-control total_customer_order" name="total_customer_order" @error("total_customer_order") is-invalid @enderror readonly>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description_customer_order">{{$customerorder->description_customer_order}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('commandeventes.index')}}" class="btn btn-cancel">Cancel</a>
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
        $('tbody').delegate('.ProductName', 'change', function() {
                var tr = $(this).parent().parent().parent().parent().parent();
                tr.find('.qty_line_customer_order').focus();
            });

            function totalVente() {
                var totalVente = 0;
                $('.subtotal_line_customer_order').each(function(i, e) {
                    var soustotal = $(this).val() - 0;
                    totalVente += soustotal;
                })
                $('.total_customer_order').val(totalVente);
            }
            $('tbody').delegate('.products_id ', 'change', function() {
                var tr = $(this).parent().parent().parent().parent().parent();
                var prixvente = tr.find('.products_id option:selected').attr(
                    'data-price_line_customer_order');
                tr.find('.price_line_customer_order').val(prixvente);
                var qty = tr.find('.qty_line_customer_order').val() - 0;
                var prixvente = tr.find('.price_line_customer_order').val() - 0;
                var soustotal = qty * prixvente;
                tr.find('.subtotal_line_customer_order').val(soustotal);
                totalVente();
            });
            $('tbody').delegate('.qty_line_customer_order,.price_line_customer_order', 'change', function() {
                var tr = $(this).parent().parent().parent().parent();
                var qty = tr.find('.qty_line_customer_order').val() - 0;
                var prixvente = tr.find('.price_line_customer_order').val() - 0;
                var soustotal = qty * prixvente;
                tr.find('.subtotal_line_customer_order').val(soustotal);
                totalVente();
            });


            $('.addline').on('click', function() {

                addline()
            });

            function addline() {
                var addline = `<tr>
                                            <td class="productimgname">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-sm-3 col-3">
                                                            <select class="js-example-basic-single select2 form-control ProductName products_id" id="elementvente"  name="products_id[]" data-placeholder="Choisir un produit"  @error('products_id') is-invalid @enderror>
                                                                <option selected="true" disabled="true">Choisir Produit</option>
                                                                @foreach ($products as $product)
                                                                    <option @if($lingecustomer->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_customer_order="{{ $product->price_sale }}">
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
                                                        <input type="number" name="qty_line_customer_order[]"
                                                            class="form-control qty_line_customer_order" value="{{$lingecustomer->qty_line_customer_order}}"
                                                            @error('qty_line_customer_order') is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_line_customer_order[]" value="{{$lingecustomer->price_line_customer_order}}"
                                                            class="form-control price_line_customer_order"
                                                            @error('price_line_customer_order') is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number"
                                                            class="form-control subtotal_line_customer_order"
                                                            name="subtotal_line_customer_order[]" value="{{$lingecustomer->subtotal_line_customer_order}}"
                                                            @error('subtotal_line_customer_order') is-invalid @enderror
                                                            readonly>
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
            //select 2
            $('#elementvente').attr('id', newSelectId).select2({tags: true});
            };


            $('tbody').delegate('.remove', 'click', function() {
                var l = $('tbody tr').length;
                if (l == 1) {
                    alert('Vous etes sur de Supprimer')
                } else {
                    $(this).parent().parent().remove();
                    totalVente();
                }
            })

        });
    </script>


@endsection
