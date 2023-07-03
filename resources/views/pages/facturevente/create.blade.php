@extends('layouts.master')
@section('title', 'Gestion Facture Vente')

@section('title_toolbar', 'Nouveau Facture Vente')
@section('subtitle_toolbar', 'Gestion des Factures Ventes')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('ventefactures.store', $delivery->id) }}" id="form">
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
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom Produit</th>
                                            <th>Qte</th>
                                            <th>Prix</th>
                                            <th>Sous Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lignedeliveries as $lignedelivery)
                                            <tr>
                                                <td class="productimgname">
                                                    <div class="form-group">
                                                        <div class="col-md-10 d-flex">
                                                            <input type="text"
                                                                value="{{$lignedelivery->product->name_product}}"
                                                                class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                            <input type="hidden" value="{{$lignedelivery->products_id}}"
                                                                name="products_id[]" class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number" name="qty_line_customer_invoice[]" value="{{$lignedelivery->qty_line_order}}"
                                                                class="form-control qty_line_customer_invoice"
                                                                @error('qty_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control price_line_customer_invoice" value="{{$lignedelivery->price_line_deliverie}}"
                                                                name="price_line_customer_invoice[]"
                                                                @error('price_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control subtotal_line_customer_invoice"
                                                                name="subtotal_line_customer_invoice[]" value="{{$lignedelivery->subtotal_line_deliverie}}"
                                                                @error('subtotal_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
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
                                            <input type="number" class="form-control total_customer_invoices" value="{{$delivery->customer_order->total_customer_order}}" name="total_customer_invoices" @error("total_customer_invoices") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_customer_invoices"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{ route('livraisons.index') }}" class="btn btn-cancel">Cancel</a>
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
                tr.find('.qty_line_customer_invoice').focus();
            });

            function totalVente() {
                var totalAchat = 0;
                $('.subtotal_line_customer_invoice').each(function(i, e) {
                    var soustotal = $(this).val() - 0;
                    totalVente += soustotal;
                })
                $('.total_customer_invoices').val(totalVente);
            }
            $('tbody').delegate('.products_id ', 'change', function() {
                var tr = $(this).parent().parent().parent().parent().parent();
                var prixvente = tr.find('.products_id option:selected').attr(
                    'data-price_line_purchase_order');
                tr.find('.price_line_customer_invoice').val(prixvente);
                var qty = tr.find('.qty_line_customer_invoice').val() - 0;
                var prixvente = tr.find('.price_line_customer_invoice').val() - 0;
                var soustotal = qty * prixvente;
                tr.find('.subtotal_line_customer_invoice').val(soustotal);
                totalVente();
            });
            $('tbody').delegate('.qty_line_customer_invoice,.price_line_customer_invoice', 'change', function() {
                var tr = $(this).parent().parent().parent().parent();
                var qty = tr.find('.qty_line_customer_invoice').val() - 0;
                var prixvente = tr.find('.price_line_customer_invoice').val() - 0;
                var soustotal = qty * prixvente;
                tr.find('.subtotal_line_customer_invoice').val(soustotal);
                totalVente();
            });


            $('.addline').on('click', function() {

                addline()
            });

            function addline() {
                var addline = ` <tr>
                                                <td class="productimgname">
                                                    <div class="form-group">
                                                        <div class="col-md-10 d-flex">
                                                            <input type="text"
                                                                value="{{$lignedelivery->product->name_product}}"
                                                                class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                            <input type="hidden" value="{{$lignedelivery->products_id}}"
                                                                name="products_id[]" class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number" name="qty_line_customer_invoice[]" value="{{$lignedelivery->qty_line_order}}"
                                                                class="form-control qty_line_customer_invoice"
                                                                @error('qty_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control price_line_customer_invoice" value="{{$lignedelivery->price_line_deliverie}}"
                                                                name="price_line_customer_invoice[]"
                                                                @error('price_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control subtotal_line_customer_invoice"
                                                                name="subtotal_line_customer_invoice[]" value="{{$lignedelivery->subtotal_line_deliverie}}"
                                                                @error('subtotal_line_customer_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>`
                $('tbody').append(addline);
            };

            $('tbody').delegate('.remove', 'click', function() {
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
