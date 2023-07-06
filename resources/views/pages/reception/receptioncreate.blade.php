@extends('layouts.master')
@section('title', 'Gestion Reception')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }

    </style>
@endsection
@section('title_toolbar', 'Nouveau Reception')
@section('subtitle_toolbar', 'Gestion des Receptions')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('commandeachats.receptstore',$purchaseorder->id) }}" id="receptionform">
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
                                    <label>Fournisseur</label>
                                    <ul>
                                        <li>{{$purchaseorder->supplier->name_supplier}}</li>
                                        <li>{{$purchaseorder->supplier->email_supplier}}</li>
                                        <li>{{$purchaseorder->supplier->tel_supplier}}</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Commande Achat</label>
                                    <ul>
                                        <li>{{$purchaseorder->num_purchase_order}}</li>
                                        <li>{{$purchaseorder->stats_purchase_order}}</li>
                                        <li>{{$purchaseorder->created_at}}</li>
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
                                            <th>Qte Recept </th>
                                            <th>Prix</th>
                                            <th>Sous Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lingepurchaseorder as $lingepurchase)
                                    <tr>
                                        <td class="productimgname">
                                            <div class="form-group">
                                                <div class="col-md-10 d-flex">
                                                    <input type="text" value="{{$lingepurchase->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                    <input type="hidden" value="{{$lingepurchase->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->qty_line_purchase_order}}" name="qty_line_reception[]" class="form-control qty_line_reception"  @error("qty_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->qty_line_recept}}" name="qty_line_recept[]" class="form-control qty_line_recept"  @error("qty_line_recept") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->qty_line_purchase_order}}" class="form-control qty_recu_line_reception" name="qty_recu_line_reception[]" @error("qty_recu_line_reception") is-invalid @enderror >
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->price_line_purchase_order}}"  class="form-control price_line_reception" name="price_line_reception[]" @error("price_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->subtotal_line_purchase_order}}"  class="form-control subtotal_line_reception" name="subtotal_line_reception[]" @error("subtotal_line_reception") is-invalid @enderror readonly>
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
                                            <input type="number" class="form-control total_reception" value="{{$purchaseorder->total_purchase_order}}" name="total_reception" @error("total_reception") is-invalid @enderror readonly>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description_reception"></textarea>
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
        $("#receptionform").validate({
             ignore: [],
            rules: {
                "qty_recu_line_reception[]": {
                    required: true,
                    digits: true
                },


            },
            messages: {

                "qty_recu_line_reception[]":{
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
        $('.products_id').select2({
                placeholder: $(this).data('placeholder'),
            });
        $('tbody').delegate('.ProductName', 'change', function() {
            var tr = $(this).parent().parent().parent().parent().parent();
            tr.find('.qty_recu_line_reception').focus();
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
                                                            <div class="col-md-10">
                                                                <input type="hidden" value="{{$lingepurchase->products_id}}" name="products_id[]" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                                <input type="text" value="{{$lingepurchase->product->name_product}}" class="form-control products_id"  @error("products_id") is-invalid @enderror readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" value="{{$lingepurchase->qty_line_purchase_order}}" name="qty_line_reception[]" class="form-control qty_line_reception"  @error("qty_line_reception") is-invalid @enderror readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" value="{{$lingepurchase->qty_line_recept}}" name="qty_line_recept[]" class="form-control qty_line_recept"  @error("qty_line_recept") is-invalid @enderror readonly>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-md-10">
                                                        <input type="number" value="{{$lingepurchase->qty_line_purchase_order}}" id="qty" class="form-control qty_recu_line_reception" name="qty_recu_line_reception[]" @error("qty_recu_line_reception") is-invalid @enderror >
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->price_line_purchase_order}}"  class="form-control price_line_reception" name="price_line_reception[]" @error("price_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <input type="number" value="{{$lingepurchase->subtotal_line_purchase_order}}"  class="form-control subtotal_line_reception" name="subtotal_line_reception[]" @error("subtotal_line_reception") is-invalid @enderror readonly>
                                                </div>
                                            </div>
                                        </td>
                                            <td>
                                                <a class="delete-set remove"><img src="assets/img/icons/delete.svg"
                                                        alt="svg"></a>
                                            </td>
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

