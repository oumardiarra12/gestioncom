@extends('layouts.master')
@section('title', 'Gestion Devis')

@section('title_toolbar', 'Detail Devis')
@section('subtitle_toolbar', 'Gestion des Devis')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('devis.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <h2>Detail Devis : {{ $estimate->num_estimates }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('devis.pdfdevis', $estimate->id) }}"><img src="assets/img/icons/pdf.svg"
                                alt="img"></a>
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
                                                        Info Client</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{ $estimate->customer->firstname_customer }}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{ $estimate->customer->lastname_customer }}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                            data-cfemail="3a4d5b565117535417594f494e55575f487a5f425b574a565f14595557">[{{ $estimate->customer->email_customer }}&#160;protected]</a>
                                                    </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{ $estimate->customer->tel_customer }}</font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font
                                                        style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                        {{ $estimate->customer->address_customer }}</font>
                                                </font><br>
                                            </td>
                                            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                <font style="vertical-align: inherit;margin-bottom:25px;">
                                                    <font
                                                        style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">
                                                        Info Devis</font>
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
                                                        {{ $estimate->num_estimates }} </font>
                                                </font><br>
                                                <font
                                                    style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">
                                                    {{ $estimate->created_at->format('d-m-Y') }} </font>
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
                                Prix Vente
                            </td>

                            <td
                                style="padding: 5px;vertical-align: middle;font-weight: 600;color: #5E5873;font-size: 14px;padding: 10px; ">
                                Sous total
                            </td>
                        </tr>
                        @foreach ($ligneestimates as $ligneestimate)
                            <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                                <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                    {{ $ligneestimate->product->name_product }}
                                </td>
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{ $ligneestimate->qty_line_estimate }}
                                </td>
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{ $ligneestimate->price_line_estimate }}
                                </td>
                                <td style="padding: 10px;vertical-align: top; ">
                                    {{ $ligneestimate->subtotal_line_estimate }}
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
                                <h5>{{ $estimate->total_estimates }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Description</h4>
                    <p>{{ $estimate->description_estimates }}</p>
                </div>
            </div>
            @if ($estimate->status_estimates=="in progress")
            <form method="POST" action="{{ route('devis.updatestatus', $estimate->id) }}">
                @method('put')
                @csrf
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="select" name="status_estimates">
                            <option>Choose Status</option>
                                <option value="in progress">En Cours</option>
                                <option value="valid">Valider</option>
                                <option value="dismiss">Annuler</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="btn btn-submit me-2">Update</button>
                    <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                </div>
            </div>
        </form>
        @endif
        </div>
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });
        </script>
    @endsection
