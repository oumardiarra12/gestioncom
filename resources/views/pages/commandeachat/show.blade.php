@extends('layouts.master')
@section('title', 'Gestion Commande Achat')

@section('title_toolbar', 'Detail Commande Achat')
@section('subtitle_toolbar', 'Gestion des Commande Achat')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('commandeachats.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <h2>Detail Commande : {{$purchaseorder->num_purchase_order}}</h2>
                <ul>
                    <li>
                        <a href="{{route('commandeachats.commandeachatpdf',$purchaseorder->id)}}"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
            <div class="invoice-box table-height"
                style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                    <tbody>
                        <tr class="top">
                            <td colspan="6" style="padding: 5px;vertical-align: top;">
                                <table style="width: 100%;line-height: inherit;text-align: left;">
                                    <tbody>
                                        <tr>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Info Fournisseur</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$purchaseorder->supplier->name_supplier}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="3a4d5b565117535417594f494e55575f487a5f425b574a565f14595557">[{{$purchaseorder->supplier->email_supplier}}&#160;protected]</a>
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$purchaseorder->supplier->tel_supplier}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$purchaseorder->supplier->address_supplier}}</font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Info Commande Achat</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Reference </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Status</font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        &nbsp;</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$purchaseorder->num_purchase_order}} </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                                        {{$purchaseorder->stats_purchase_order}}</font>
                                                </font><br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr class="heading " style="background: #F3F2F7;">
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                               Nom Produit
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                QTE
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Prix Achat
                            </td>

                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                               Sous total
                            </td>
                        </tr>
                        @foreach ($lingepurchaseorder as $linepurchase)
                        <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                               {{$linepurchase->product->name_product}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$linepurchase->qty_line_purchase_order}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$linepurchase->price_line_purchase_order}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$linepurchase->subtotal_line_purchase_order}}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="row">
                    <div class="col-lg-12 ">
                        <div class="total-order w-100 max-widthauto m-auto mb-4">
                            <ul>
                                <li class="total">
                                    <h4>Total</h4>
                                    <h5>{{$purchaseorder->total_purchase_order}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="total-order w-100 max-widthauto m-auto mb-4">
                        <ul>
                            <li class="total">
                                <h4>Description</h4>
                                <p>{{$purchaseorder->description_purchase_order}}</p>
                            </li>
                        </ul>
                    </div>
                </div>

        </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>
@endsection
