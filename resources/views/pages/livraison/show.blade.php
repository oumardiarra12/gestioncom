@extends('layouts.master')
@section('title', 'Gestion Livraison')

@section('title_toolbar', 'Detail Livraison')
@section('subtitle_toolbar', 'Gestion des Livraisons')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('livraisons.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <h2>Detail Livraison : {{$delivery->num_deliveries}}</h2>
                <ul>
                    <li>
                        <a href="{{route('livraisons.livraisonpdf',$delivery->id)}}"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
            <div class="invoice-box table-height"
                style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                    <tbody>
                        <tr class="top">
                            <td colspan="6" style="padding: 5px;vertical-align: top;">
                              @if ($customerorder)
                              <table style="width: 100%;line-height: inherit;text-align: left;">
                                <tbody>
                                    <tr>
                                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                                <font
                                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                    Info clients</font>
                                            </font><br>
                                            <font style="vertical-align: inherit;">
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    {{$delivery->customer_order->customer->firstname_customer ?? ''}}</font>
                                            </font><br>
                                            <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    {{$delivery->customer_order->customer->lastname_customer ?? ''}}</font>
                                            </font><br>
                                            <font style="vertical-align: inherit;">
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="3a4d5b565117535417594f494e55575f487a5f425b574a565f14595557">[{{$delivery->customer_order->customer->email_customer ?? ''}}&#160;protected]</a>
                                                </font>
                                            </font><br>
                                            <font style="vertical-align: inherit;">
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    {{$delivery->customer_order->customer->tel_customer ?? ''}}</font>
                                            </font><br>
                                            <font style="vertical-align: inherit;">
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    {{$delivery->customer_order->customer->address_customer ?? ''}}</font>
                                            </font><br>
                                        </td>
                                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                                <font
                                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                    Info Commande Vente</font>
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
                                                    {{$delivery->customer_order->num_customer_order ?? ''}} </font>
                                            </font><br>
                                            <font style="vertical-align: inherit;">
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                                    {{$delivery->customer_order->status_customer_order ?? ''}}</font>
                                            </font><br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                              @endif
                            </td>
                        </tr>
                        <tr class="heading " style="background: #F3F2F7;">
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                               Nom Produit
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                QTE CMD
                            </td>
                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                QTE Livraison
                            </td>
                        </tr>
                        @foreach ( $lignedeliveries as  $lignedelivery)
                        <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                            <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                               {{$lignedelivery->product->name_product}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$lignedelivery->qty_line_deliverie}}
                            </td>
                            <td style="padding: 10px;vertical-align: top; ">
                                {{$lignedelivery->qty_line_order}}
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
                                    <h4>Description</h4>
                                    <div>{{$delivery->description_deliveries}}</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- @if ($purchaseorder->stats_purchase_order ==  "in progress")
                    <form method="POST" action="{{ route('commandeachats.updatestatus', $purchaseorder->id) }}">
                        @method('put')
                        @csrf
                    <div class="col-lg-12">

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select" name="stats_purchase_order">
                                    <option @if($purchaseorder->stats_purchase_order ==  "in progress" || old('stats_purchase_order') == "in progress") selected @endif value="in progress">En Cours</option>
                                    <option @if($purchaseorder->stats_purchase_order ==  "receipt" || old('stats_purchase_order') == "receipt") selected @endif value="receipt">Receptionner</option>
                                    <option @if($purchaseorder->stats_purchase_order ==  "cancel" || old('stats_purchase_order') == "cancel") selected @endif value="cancel">Annuler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Update</button>
                        <a href="{{route('commandeachats.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </form>
                    @endif --}}

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
