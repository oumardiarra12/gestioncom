@extends('layouts.master')
@section('title', 'Gestion Retour Achat')

@section('title_toolbar', 'Detail Retour Achat')
@section('subtitle_toolbar', 'Gestion des Retour Achat')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('retournachats.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <h2>Detail Retour Achat : {{$returnPurchase->num_return_purchase}}</h2>
                <ul>
                    <li>
                        <a href="{{route('retournachats.pdfretourachat',$returnPurchase->id)}}"><img src="assets/img/icons/pdf.svg" alt="img"></a>
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
                                                        {{$returnPurchase->supplier->name_supplier}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="3a4d5b565117535417594f494e55575f487a5f425b574a565f14595557">[{{$returnPurchase->supplier->email_supplier}}&#160;protected]</a>
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$returnPurchase->supplier->tel_supplier}}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{$returnPurchase->supplier->address_supplier}}</font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Info Retour Achat</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        Reference </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                       Date</font>
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
                                                        {{$returnPurchase->num_return_purchase}} </font>
                                                </font><br>
                                                <font
                                                style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                {{$returnPurchase->created_at->format('d-m-Y')}} </font>
                                        </font><br>
                                                <font style="vertical-align: inherit;">

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
                        @foreach ( $lignereturnPurchases as  $lignereturnPurchase)
                        <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                               {{$lignereturnPurchase->product->name_product}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$lignereturnPurchase->qty_line_return_purchase}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$lignereturnPurchase->price_return_purchase}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$lignereturnPurchase->subtotal_return_purchase}}
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
                                    <h5>{{$returnPurchase->total_return_purchase}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <h4>Description</h4>
                       <p>{{$returnPurchase->description_return_purchase}}</p>
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
