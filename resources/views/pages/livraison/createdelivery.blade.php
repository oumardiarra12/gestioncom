@extends('layouts.master')
@section('title', 'Gestion Livraison')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }

    </style>
@endsection
@section('title_toolbar', 'Nouveau Livraison')
@section('subtitle_toolbar', 'Gestion des Livraisons')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('commandeventes.deliverystore', $customerorder->id) }}" id="deliveryform">
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
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Client</label>
                                    <ul>
                                        <li>{{$customerorder->customer->firstname}}</li>
                                        <li>{{$customerorder->customer->lastname}}</li>
                                        <li>{{$customerorder->customer->email_customer}}</li>
                                        <li>{{$customerorder->customer->tel_custome}}</li>
                                        <li>{{$customerorder->customer->address_customer}}</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Commande Vente</label>
                                    <ul>
                                        <li>{{$customerorder->num_customer_order}}</li>
                                        <li>{{$customerorder->status_customer_order}}</li>
                                        <li>{{$customerorder->created_at->format('d-m-Y')}}</li>
                                    </ul>
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
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nom Produit</th>
                                            <th>Qte CMD</th>
                                            <th>Qte Recu</th>
                                            <th>Qte Livraison </th>
                                            <th>Prix</th>
                                            <th>Sous Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lingecustomerorder as $lingecustomer)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10 d-flex">
                                                    <input type="text" value="{{$lingecustomer->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                    <input type="hidden" value="{{$lingecustomer->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_customer_order}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_delivery}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_customer_order}}" class="form-control qty_line_order" name="qty_line_order[]" @error("qty_line_order") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->price_line_customer_order}}"  class="form-control price_line_deliverie" name="price_line_deliverie[]" @error("price_line_deliverie") is-invalid @enderror readonly >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->subtotal_line_customer_order}}"  class="form-control subtotal_line_deliverie" name="subtotal_line_deliverie[]" @error("subtotal_line_deliverie") is-invalid @enderror readonly >
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
                                            <input type="number" class="form-control total_deliveries" value="{{$customerorder->total_customer_order}}" name="total_deliveries" @error("total_reception") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_deliveries"></textarea>
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
        $("#deliveryform").validate({
             ignore: [],
            rules: {
                "qty_line_order[]": {
                    required: true,
                    digits: true
                },


            },
            messages: {

                "qty_line_order[]":{
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

        $('tbody').delegate('.ProductName', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            tr.find('.qty_line_order').focus();
        });

        // function totalVente() {
        //     var totalVente =0;
        //     $('.subtotal_line_deliverie').each(function(i, e){
        //         var soustotal = $(this).val() - 0;
        //         totalVente += soustotal;
        //     })
        //     $('.total_deliveries').val(totalVente);
        // }
        // $('tbody').delegate('.products_id ', 'change', function() {
        //     var tr = $(this).parent().parent().parent().parent().parent();
        //     var prixachat=tr.find('.products_id option:selected').attr('data-price_line_purchase_order');
        //     tr.find('.price_line_purchase_order').val(prixachat);
        //     var qty = tr.find('.qty_line_purchase_order').val()-0;
        //     var prixachat = tr.find('.price_line_purchase_order').val()-0;
        //     var soustotal = qty * prixachat;
        //     tr.find('.subtotal_line_purchase_order').val(soustotal);
        //     totalAchat();
        // });
        // $('tbody').delegate('.qty_line_purchase_order,.price_line_purchase_order','change',function(){
        //     var tr = $(this).parent().parent().parent().parent();
        //     var qty = tr.find('.qty_line_purchase_order').val()-0;
        //     var prixachat = tr.find('.price_line_purchase_order').val()-0;
        //     var soustotal = qty * prixachat;
        //     tr.find('.subtotal_line_purchase_order').val(soustotal);
        //     totalAchat();
        // });


        $('.addline').on('click', function() {

            addline()
        });

        function addline() {
            var addline = `<tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10 d-flex">
                                                    <input type="text" value="{{$lingecustomer->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                    <input type="hidden" value="{{$lingecustomer->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_customer_order}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_delivery}}" name="qty_line_deliverie[]" class="form-control qty_line_deliverie"  @error("qty_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->qty_line_customer_order}}" class="form-control qty_line_order" id="qty" name="qty_line_order[]" @error("qty_line_order") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->price_line_customer_order}}"  class="form-control price_line_deliverie" name="price_line_deliverie[]" @error("price_line_deliverie") is-invalid @enderror readonly >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingecustomer->subtotal_line_customer_order}}"  class="form-control subtotal_line_deliverie" name="subtotal_line_deliverie[]" @error("subtotal_line_deliverie") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        // <td>
                                        //     <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                        //             alt="svg"></a>
                                        // </td>
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

