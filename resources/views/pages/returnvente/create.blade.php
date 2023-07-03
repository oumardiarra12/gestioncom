@extends('layouts.master')
@section('title', 'Gestion Retour Vente')

@section('title_toolbar', 'Nouveau Retour Ventes')
@section('subtitle_toolbar', 'Gestion des Retour Ventes')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('retournventes.store') }}" id="form">
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
                                    <label>Client</label>
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-10 col-10">
                                            <select class="js-example-basic-single select2" name="customers_id">
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->firstname_customer }} {{ $customer->lastname_customer }}
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
                                            <th>Prix Vente </th>
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
                                                                    <option value="{{ $product->id }}" data-price_line_customer_order="{{$product->price_purchase}}">
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
                                                        <input type="number" name="qty_line_return_customer[]" class="form-control qty_line_return_customer"  @error("qty_line_return_customer") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_return_customer[]" class="form-control price_return_customer"  @error("price_return_customer") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control subtotal_return_customer" name="subtotal_return_customer[]" @error("subtotal_return_customer") is-invalid @enderror readonly>
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
                                            <input type="number" class="form-control total_return_customer" name="total_return_customer" @error("total_return_customer") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_return_customer"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{route('retournventes.index')}}" class="btn btn-cancel">Cancel</a>
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
            tr.find('.qty_line_return_customer').focus();
        });

        function totalVente() {
            var totalRetourVente =0;
            $('.subtotal_return_customer').each(function(i, e){
                var soustotal = $(this).val() - 0;
                totalRetourVente += soustotal;
            })
            $('.total_return_customer').val(totalRetourVente);
        }
        $('tbody').delegate('.products_id ', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            var prixRetourvente=tr.find('.products_id option:selected').attr('data-price_line_customer_order');
            tr.find('.price_return_customer').val(prixRetourvente);
            var qty = tr.find('.qty_line_return_customer').val()-0;
            var prixRetourvente = tr.find('.price_return_customer').val()-0;
            var soustotal = qty * prixRetourvente;
            tr.find('.subtotal_return_customer').val(soustotal);
            totalVente();
        });
        $('tbody').delegate('.qty_line_return_customer,.price_return_customer','change',function(){
            var tr = $(this).parent().parent().parent().parent();
            var qty = tr.find('.qty_line_return_customer').val()-0;
            var prixRetourvente = tr.find('.price_return_customer').val()-0;
            var soustotal = qty * prixRetourvente;
            tr.find('.subtotal_return_customer').val(soustotal);
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
                                                        <div class="col-lg-10 col-sm-10 col-10">
                                                            <select class="js-example-basic-single select2 form-control ProductName products_id" id="element" name="products_id[]" data-placeholder="Choisir un produit"  @error("products_id") is-invalid @enderror>
                                                                <option selected="true" disabled="true">Choisir Produit</option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}" data-price_line_customer_order="{{$product->price_purchase}}">
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
                                                        <input type="number" name="qty_line_return_customer[]" class="form-control qty_line_return_customer"  @error("qty_line_return_customer") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" name="price_return_customer[]" class="form-control price_return_customer"  @error("price_return_customer") is-invalid @enderror>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control subtotal_return_customer" name="subtotal_return_customer[]" @error("subtotal_return_customer") is-invalid @enderror readonly>
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
            $('#element').attr('id', newSelectId).select2({tags: true});
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

