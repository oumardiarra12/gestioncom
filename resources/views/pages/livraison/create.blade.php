@extends('layouts.master')
@section('title', 'Gestion Livraison')

@section('title_toolbar', 'Livraison')
@section('subtitle_toolbar', 'Gestion des Vente')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('livraisons.store') }}">
                @csrf
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Fournisseur</label>
                        <div class="row">
                            <div class="col-lg-10 col-sm-10 col-10">
                                <select class="select">
                                    <option>Select</option>
                                    <option>Supplier</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                                <div class="add-icon">
                                    <a href="javascript:void(0);"><img src="assets/img/icons/plus1.svg" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Nom Produit</label>
                        <div class="input-groupicon">
                            <input type="text" placeholder="Scan/Recherche Produit par code et select..."
                                name="product_code_name" id="lims_productcodeSearch">
                            <div class="addonset">
                                <img src="assets/img/icons/scanners.svg" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom Produit</th>
                                <th>QTE</th>
                                <th>Prix </th>
                                <th>Sous Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td class="productimgname">
                                    <input type="text" value="product1" />
                                    <input type="hidden" name="products_id[]"  />
                                </td>
                                <td><input type="number" name="qte[]" value="1"/></td>
                                <td><input type="number" name="delevery_price[]" value="2000"/></td>
                                <td><input type="number" name="delevery_subtotal[]" value="2000"/></td>
                                <td>
                                    <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="productimgname">
                                    <input type="text" value="product2" />
                                    <input type="hidden" name="products_id[]"  />
                                </td>
                                <td><input type="number" name="qte[]" value="1"/></td>
                                <td><input type="number" name="delevery_price[]" value="2000"/></td>
                                <td><input type="number" name="delevery_subtotal[]" value="2000"/></td>
                                <td>
                                    <a class="delete-set"><img src="assets/img/icons/delete.svg" alt="svg"></a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 float-md-right">
                    <div class="total-order">
                        <ul>
                            <li class="total">
                                <h4>Grand Total</h4>
                                <h5><input type="text" class="total_livraison form-control-plaintext"
                                        name="total_deliveries" /> </h5>
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
                    <button  class="btn btn-submit me-2">Submit</button>
                    <a href="purchaselist.html" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function getSubtotal(quantity, price) {
            return (quantity * price);
        }
        function totalLiv() {
            var totalLiv = 0;
            $('.subtotal_line_livraison').each(function(i, e) {
                var soustotal = $(this).val() - 0;
                totalLiv += soustotal;
            })
            $('.total_livraison').val(totalLiv);
        }
        $('tbody').delegate('.qty_line_livraison,.price_line_livraison', 'change', function() {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty_line_livraison').val() - 0;
            var prixachat = tr.find('.price_line_livraison').val() - 0;
            var soustotal = qty * prixachat;
            tr.find('.subtotal_line_livraison').val(soustotal);
            totalLiv();

        });
        var path = "{{ route('livraisons.researchproduct') }}";

        $("#lims_productcodeSearch").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#lims_productcodeSearch').val(ui.item.label);
                var rowindex = $(this).parents("tr").index();
                var newRow = `<tr>
        <td><input type="text" class="product_id form-control-plaintext" id="` + rowindex + `" value="` + ui.item
                    .label + `" readonly />
            <input type="hidden" name="products_id[]" id="` + rowindex + `" value="` + ui.item.value + `"  /></td>
            <td><input type="number" id="` + rowindex + `" class="qty_line_livraison" name="qte[]" value="1"/></td>
            <td><input type="number" id="` + rowindex +
                    `" class="price_line_livraison" name="delevery_price[]" value="` + ui.item
                    .prix + `"/></td>
            <td><input type="text" id="` + rowindex + `" class="form-control-plaintext subtotal_line_livraison" value="`+getSubtotal(ui.item.prix,1)+`" name="delevery_subtotal[]"  readonly /></td>
            <td><button type="button" class="ibtnDel btn btn-md btn-danger">Delete</button></td>
        </td>

        </tr>`
                $("table tbody").append(newRow);
                $('#lims_productcodeSearch').val('');
                totalLiv();
                return false;
            }

        });
        // $(document).on("click", "#lims_productcodeSearch", function() {
        //     console.log('je suis click')
        //     updateitem($(this).closest('tr'))
        // })
        $('tbody').delegate('.ibtnDel', 'click', function() {
            var l = $('tbody tr').length;
            if (l == 1) {
                alert('Vous etes sur de Supprimer')
            } else {
                $(this).parent().parent().remove();
                totalLiv()
            }
        })
    </script>

@endsection
