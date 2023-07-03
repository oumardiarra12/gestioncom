@extends('layouts.master')
@section('title', 'Gestion Devis')

@section('title_toolbar', 'Edit Devis')
@section('subtitle_toolbar', 'Gestion desDevis')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('devis.update', $estimate->id) }}">
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
                                <label>Client</label>
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-10">
                                        <select class="js-example-basic-single select2" name="customers_id">
                                            @foreach ($customers as $customer)
                                                <option @if($estimate->customers_id ==  $customer->id || old('customers_id') == $customer->id) selected @endif  value="{{ $customer->id }}">{{ $customer->firstname_customer }} {{ $customer->lastname_customer }}
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
                                        <th>Prix Vente </th>
                                        <th>Sous Total </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ligneestimates as $ligneestimate)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-10 col-10">
                                                        <select class="form-control ProductName products_id" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                            <option selected="selected">-----</option>
                                                            @foreach ($products as $product)
                                                                <option @if($ligneestimate->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_customer_order="{{$product->price_sale}}">
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
                                                    <input type="number" value="{{$ligneestimate->qty_line_estimate}}" name="qty_line_estimate[]" class="form-control qty_line_estimate"  @error("qty_line_estimate") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$ligneestimate->price_line_estimate}}" name="price_line_estimate[]" class="form-control price_line_estimate"  @error("price_line_estimate") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$ligneestimate->subtotal_line_estimate}}" class="form-control subtotal_line_estimate" name="subtotal_line_estimate[]" @error("subtotal_line_estimate") is-invalid @enderror readonly>
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
                                        <input type="number" value="{{$estimate->total_estimates}}" class="form-control total_estimates" name="total_estimates" @error("total_estimates") is-invalid @enderror readonly>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control"  name="description_estimates">{{$estimate->description_estimates}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('devis.index')}}" class="btn btn-cancel">Cancel</a>
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
            tr.find('.qty_line_estimate').focus();
        });

        function totalVente() {
            var totalRetourVente =0;
            $('.subtotal_line_estimate').each(function(i, e){
                var soustotal = $(this).val() - 0;
                totalRetourVente += soustotal;
            })
            $('.total_estimates').val(totalRetourVente);
        }
        $('tbody').delegate('.products_id ', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            var prixRetourvente=tr.find('.products_id option:selected').attr('data-price_line_customer_order');
            tr.find('.price_line_estimate').val(prixRetourvente);
            var qty = tr.find('.qty_line_estimate').val()-0;
            var prixRetourvente = tr.find('.price_line_estimate').val()-0;
            var soustotal = qty * prixRetourvente;
            tr.find('.subtotal_line_estimate').val(soustotal);
            totalVente();
        });
        $('tbody').delegate('.qty_line_estimate,.price_line_estimate','change',function(){
            var tr = $(this).parent().parent().parent().parent();
            var qty = tr.find('.qty_line_estimate').val()-0;
            var prixRetourvente = tr.find('.price_line_estimate').val()-0;
            var soustotal = qty * prixRetourvente;
            tr.find('.subtotal_line_estimate').val(soustotal);
            totalVente();
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
                                                                <option @if($ligneestimate->products_id ==  $product->id || old('products_id') == $product->id) selected @endif value="{{ $product->id }}" data-price_line_customer_order="{{$product->price_sale}}">
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
                                                    <input type="number" value="{{$ligneestimate->qty_line_estimate}}" name="qty_line_estimate[]" class="form-control qty_line_estimate"  @error("qty_line_estimate") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$ligneestimate->price_line_estimate}}" name="price_line_estimate[]" class="form-control price_line_estimate"  @error("price_line_estimate") is-invalid @enderror>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$ligneestimate->subtotal_line_estimate}}" class="form-control subtotal_line_estimate" name="subtotal_line_estimate[]" @error("subtotal_line_estimate") is-invalid @enderror readonly>
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
                 totalVente()
            }
        })
    });
    </script>


@endsection