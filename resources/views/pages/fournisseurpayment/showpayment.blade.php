@extends('layouts.master')
@section('title', 'Gestion Fournisseur Paiement')

@section('title_toolbar', 'Show Liste Fournisseur Paiement')
@section('subtitle_toolbar', 'Gestion des Fournisseur Paiements')
@section('content')
    <div class="card">
        <div class="card-body">
            <table style="width: 100%;line-height: inherit;text-align: left;">
                <tbody>
                    <tr>
                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                <font
                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                    Info Facture</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"><span
                                        class="fw-bold">N :</span>{{ $purchaseinvoice->num_purchase_invoice }}</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"><span
                                        class="fw-bold">Montant :</span>{{ $purchaseinvoice->total_purchase_invoice }}
                                </font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"><span
                                        class="fw-bold">Date :</span>{{ $purchaseinvoice->created_at }}</font>
                            </font><br>
                        </td>
                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                <font
                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                    Info Fournisseur</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->supplier->name_supplier }}</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <a
                                        href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="9ffefbf2f6f1dffae7fef2eff3fab1fcf0f2">[{{ $purchaseinvoice->reception->purchase_order->supplier->email_supplier }}&#160;protected]</a>
                                </font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->supplier->tel_supplier }}</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->supplier->address_supplier }}</font>
                            </font><br>
                        </td>
                        <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                <font
                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                    Info Commande Achat</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                    Reference </font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Date
                                </font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Status
                                </font>
                            </font><br>
                        </td>
                        <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                            <font style="vertical-align: inherit;margin-bottom:25px;">
                                <font
                                    style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                    &nbsp;</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->num_purchase_order }} </font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->created_at }}</font>
                            </font><br>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;">
                                    {{ $purchaseinvoice->reception->purchase_order->stats_purchase_order }}</font>
                            </font><br>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ref. Reglement</th>
                            <th>Ref. Facture</th>
                            <th>Montant a Payer </th>
                            <th>Montant Payer </th>
                            <th>Montant Reste</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplierpayments as $supplierpayment)
                            <tr class="bor-b1">
                                <td>{{ $supplierpayment->created_at }} </td>
                                <td>{{ $supplierpayment->num_supplier_payment }}</td>
                                <td>{{ $supplierpayment->purchase_invoice->num_purchase_invoice }} </td>
                                <td>{{ $supplierpayment->amount_to_be_paid }}</td>
                                <td>{{ $supplierpayment->amount_to_pay }}</td>
                                <td>{{ $supplierpayment->reste }}</td>
                                <td>
                                    <a class="me-2" href="{{ route('supplierpayements.show', $supplierpayment->id) }}">
                                        <img src="assets/img/icons/eye1.svg" class="me-2" alt="img" />
                                    </a>
                                    <a class="me-2" href="{{ route('supplierpayements.edit', $supplierpayment->id) }}">
                                        <img src="assets/img/icons/edit.svg" alt="img">
                                    </a>
                                    <form class="delete-item d-inline confirm-text" method="post"
                                        action="{{ route('supplierpayements.delete', $supplierpayment->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-block btn-outline">
                                            <img src="assets/img/icons/delete.svg" alt="img">

                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
