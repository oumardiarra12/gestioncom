@extends('layouts.master')
@section('title', 'Gestion Livraison')

@section('title_toolbar', 'Edit Livraison')
@section('subtitle_toolbar', 'Gestion des Livraisons')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('livraisons.update',$delivery->id) }}" id="form">
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

                            {{-- <div class="col-lg-12 col-sm-6 col-12">
                                <div class="form-group d-flex flex-row-reverse">
                                    <button type="button" class="btn btn-rounded btn-info addline"><img src="assets/img/icons/plus1.svg" alt="img"></button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom Produit</th>
                                            <th>Qte CMD</th>
                                            <th>Qte Livraison </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($lignedeliveries as $lignedelivery)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10 d-flex">
                                                    <input type="text" value="{{$lignedelivery->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                    <input type="hidden" value="{{$lignedelivery->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_deliverie}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_deliverie}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_order}}" class="form-control qty_line_order" name="qty_line_order[]" @error("qty_line_order") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->price_line_deliverie}}"  class="form-control price_line_deliverie" name="price_line_deliverie[]" @error("price_line_deliverie") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->subtotal_line_deliverie}}"  class="form-control subtotal_line_deliverie" name="subtotal_line_deliverie[]" @error("subtotal_line_deliverie") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                    alt="svg"></a>
                                        </td> --}}
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
                                            <input type="number" class="form-control total_deliveries" value="{{$delivery->total_deliveries}}" name="total_deliveries" @error("total_deliveries") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control"  name="description_deliveries">{{$delivery->description_deliveries}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2">Submit</button>
                                <a href="{{route('livraisons.index')}}" class="btn btn-cancel">Cancel</a>
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
            tr.find('.qty_line_order').focus();
        });


        $('.addline').on('click', function() {

            addline()
        });

        function addline() {
            var addline = ` <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10 d-flex">
                                                    <input type="text" value="{{$lignedelivery->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                    <input type="hidden" value="{{$lignedelivery->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_deliverie}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_deliverie}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->qty_line_order}}" class="form-control qty_line_order" name="qty_line_order[]" @error("qty_line_order") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->price_line_deliverie}}"  class="form-control price_line_deliverie" name="price_line_deliverie[]" @error("price_line_deliverie") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lignedelivery->subtotal_line_deliverie}}"  class="form-control subtotal_line_deliverie" name="subtotal_line_deliverie[]" @error("subtotal_line_deliverie") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        // <td>
                                        //     <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                        //             alt="svg"></a>
                                        // </td>
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

