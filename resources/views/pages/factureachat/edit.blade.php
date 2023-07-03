@extends('layouts.master')
@section('title', 'Gestion Facture Achat')

@section('title_toolbar', 'Edit Facture Achat')
@section('subtitle_toolbar', 'Gestion des Facture Achats')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('achatfactures.update', $purchaseinvoice->id) }}" id="form">
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
                                        @foreach ($lignepurchaseinvoices as $lignepurchaseinvoice)
                                            <tr>
                                                <td class="productimgname">
                                                    <div class="form-group">
                                                        <div class="col-md-10 d-flex">
                                                            <input type="text"
                                                                value="{{ $lignepurchaseinvoice->product->name_product }}"
                                                                class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                            <input type="hidden"
                                                                value="{{ $lignepurchaseinvoice->products_id }}"
                                                                name="products_id[]" class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number" name="qty_line_purchase_invoice[]"
                                                                value="{{ $lignepurchaseinvoice->qty_line_purchase_invoice }}"
                                                                class="form-control qty_line_purchase_invoice"
                                                                @error('qty_line_purchase_invoice') is-invalid @enderror
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control price_purchase_invoice"
                                                                value="{{ $lignepurchaseinvoice->price_purchase_invoice }}"
                                                                name="price_purchase_invoice[]"
                                                                @error('price_purchase_invoice') is-invalid @enderror
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control subtotal_purchase_invoice"
                                                                name="subtotal_purchase_invoice[]"
                                                                value="{{ $lignepurchaseinvoice->subtotal_purchase_invoice }}"
                                                                @error('subtotal_purchase_invoice') is-invalid @enderror
                                                                readonly>
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
                                            <input type="number" value="{{ $purchaseinvoice->total_purchase_invoice }}"
                                                class="form-control total_purchase_invoice" name="total_purchase_invoice"
                                                @error('total_purchase_invoice') is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_purchase_invoice">{{ $purchaseinvoice->description_purchase_invoice }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{ route('achatfactures.index') }}" class="btn btn-cancel">Cancel</a>
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
                tr.find('.qty_line_purchase_invoice').focus();
            });

            function totalAchat() {
                var totalAchat = 0;
                $('.subtotal_purchase_invoice').each(function(i, e) {
                    var soustotal = $(this).val() - 0;
                    totalAchat += soustotal;
                })
                $('.total_purchase_invoice').val(totalAchat);
            }
            $('tbody').delegate('.products_id ', 'change', function() {
                var tr = $(this).parent().parent().parent().parent().parent();
                var prixachat = tr.find('.products_id option:selected').attr(
                    'data-price_line_purchase_order');
                tr.find('.price_line_purchase_invoice').val(prixachat);
                var qty = tr.find('.qty_line_purchase_invoice').val() - 0;
                var prixachat = tr.find('.price_line_purchase_invoice').val() - 0;
                var soustotal = qty * prixachat;
                tr.find('.subtotal_line_purchase_invoice').val(soustotal);
                totalAchat();
            });
            $('tbody').delegate('.qty_line_purchase_invoice,.price_line_purchase_invoice', 'change', function() {
                var tr = $(this).parent().parent().parent().parent();
                var qty = tr.find('.qty_line_purchase_invoice').val() - 0;
                var prixachat = tr.find('.price_line_purchase_invoice').val() - 0;
                var soustotal = qty * prixachat;
                tr.find('.subtotal_line_purchase_invoice').val(soustotal);
                totalAchat();
            });



            $('.addline').on('click', function() {

                addline()
            });

            function addline() {
                var addline = ` <tr>
                <tr>
                                                <td class="productimgname">
                                                    <div class="form-group">
                                                        <div class="col-md-10 d-flex">
                                                            <input type="text"
                                                                value="{{ $lignepurchaseinvoice->product->name_product }}"
                                                                class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                            <input type="hidden" value="{{ $lignepurchaseinvoice->products_id }}"
                                                                name="products_id[]" class="form-control products_id"
                                                                @error('products_id') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number" name="qty_line_purchase_invoice[]" value="{{ $lignepurchaseinvoice->qty_line_purchase_invoice }}"
                                                                class="form-control qty_line_purchase_invoice"
                                                                @error('qty_line_purchase_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control price_purchase_invoice" value="{{ $lignepurchaseinvoice->price_purchase_invoice }}"
                                                                name="price_purchase_invoice[]"
                                                                @error('price_purchase_invoice') is-invalid @enderror readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-md-10">
                                                            <input type="number"
                                                                class="form-control subtotal_purchase_invoice"
                                                                name="subtotal_purchase_invoice[]" value="{{ $lignepurchaseinvoice->subtotal_purchase_invoice }}"
                                                                @error('subtotal_purchase_invoice') is-invalid @enderror readonly>
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
