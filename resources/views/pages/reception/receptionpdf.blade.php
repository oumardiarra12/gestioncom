<!DOCTYPE html>
<html>

<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

        * {
            margin: 0;
            box-sizing: border-box;

        }

        body {
            background: #ffffff;
            font-family: 'Roboto', sans-serif;
            /* background-image: url('');
  background-repeat: repeat-y;
  background-size: 100%; */
        }

        ::selection {
            background: #f31544;
            color: #FFF;
        }

        ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        h1 {
            font-size: 1.5em;
            color: #222;
        }

        h2 {
            font-size: .9em;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        p {
            font-size: .7em;
            color: #666;
            line-height: 1.5em;
        }

        #invoiceholder {
            width: 100%;
            height: 100vh;
            /* padding-top: 20px; */
        }

        #headerimage {
            z-index: -1;
            position: relative;
            top: 0px;
            height: 350px;

            /* -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15);
            -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, .15), inset 0 -2px 4px rgba(0, 0, 0, .15); */
            overflow: hidden;
            /* background-attachment: fixed;
            background-size: 1920px 80%;
            background-position: 50% -90%; */
        }

        #invoice {
            position: relative;
            top: -290px;
            margin: 0 auto;
            width: 100%;
            height: 100vh;
            background: #FFF;
        }

        [id*='invoice-'] {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }

        #invoice-top {
            min-height: 120px;
        }

        #invoice-mid {
            min-height: 120px;
        }

        #invoice-bot {
            min-height: 250px;
        }

        .logo {
            float: left;
            height: 60px;
            width: 60px;
            /* background: url(http://michaeltruong.ca/images/logo1.png) no-repeat; */
            /* background-size: 60px 60px; */
        }

        .logo img {
            height: 60px;
            width: 60px;
        }

        .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        .info {
            display: block;
            float: left;
            margin-left: 20px;
        }

        .title {
            float: right;
        }

        .title p {
            text-align: right;
        }

        #project {
            margin-left: 22%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE
        }

        .tabletitle {
            padding: 5px;
            background: #EEE;
        }

        .service {
            border: 1px solid #EEE;
        }

        .item {
            width: 50%;
        }

        .itemtext {
            font-size: .9em;
        }

        #legalcopy {
            margin-top: 30px;
        }

        form {
            float: right;
            margin-top: 30px;
            text-align: right;
        }


        .effect2 {
            position: relative;
        }

        /* .effect2:after {
            -webkit-transform: rotate(3deg);
            -moz-transform: rotate(3deg);
            -o-transform: rotate(3deg);
            -ms-transform: rotate(3deg);
            transform: rotate(3deg);
            right: 10px;
            left: auto;
        } */



        .legal {
            width: 70%;
        }
        .signature{
            float: right;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div id="invoiceholder">

        <div id="headerimage"></div>
        <div id="invoice" class="effect2">

            <div id="invoice-top">
                <div class="logo"><img src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/logosociete/' . $company->company_logo))); ?>" alt="logo" /></div>
                <div class="info">
                    <h2>{{ $company->company_name }}</h2>
                    <p> {{ $company->company_email }} </br>
                        {{ $company->company_contact }}
                    </p>
                </div>
                <!--End Info-->
                <div class="title">
                    <h3>Bon de Reception</h3>
                    <h5>No #{{ $reception->num_reception}}</h5>
                    <p>{{ $reception->created_at->format('d-m-Y') }}</br>

                    </p>
                </div>
                <!--End Title-->
            </div>
            <!--End InvoiceTop-->



            <div id="invoice-mid">

                <div class="clientlogo"></div>
                <div class="info">
                    <h2>{{ $reception->purchase_order->supplier->name_supplier }}</h2>
                    <p>{{ $reception->purchase_order->supplier->email_contact_supplier }}</br>
                        {{ $reception->purchase_order->supplier->tel_supplier }}</br>
                </div>

                <div id="project">
                    <h2>Note</h2>
                    <p>{{ $reception->description_reception }}</p>
                </div>

            </div>
            <!--End Invoice Mid-->

            <div id="invoice-bot">

                <div id="table">
                    <table>
                        <tr class="tabletitle">
                            <td class="item">
                                <h2>Designation</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qte CMD</h2>
                            </td>
                            <td class="Hours">
                                <h2>Qte Reception</h2>
                            </td>
                            {{-- <td class="Rate">
                                <h2>Prix</h2>
                            </td>
                            <td class="subtotal">
                                <h2>Sous total</h2>
                            </td> --}}
                        </tr>
                        @foreach ($lignereceptions as $lignereception)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{$lignereception->product->name_product}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$lignereception->qty_line_reception}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$lignereception->qty_recu_line_reception}}</p>
                            </td>
                            {{-- <td class="tableitem">
                                <p class="itemtext">{{$lignereception->price_line_reception}}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{$lignereception->subtotal_line_reception}}</p>
                            </td> --}}
                        </tr>
                        @endforeach


                        {{-- <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Total</h2>
                            </td>
                            <td class="payment">
                                <h2>{{$reception->total_reception}}</h2>
                            </td>
                        </tr> --}}

                    </table>
                </div>
                <!--End Table-->

                {{-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="QRZ7QTM9XRPJ6">
                    <input type="image" src="http://michaeltruong.ca/images/paypal.png" border="0" name="submit"
                        alt="PayPal - The safer, easier way to pay online!">
                </form> --}}


                {{-- <div id="legalcopy">
                    <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days;
                        please process this invoice within that time. There will be a 5% interest charge per month on
                        late invoices.
                    </p>
                </div> --}}

            </div>
            <div class="signature">
                <h4>Le Responsable</h4>
            </div>
            <!--End InvoiceBot-->
        </div>
        <!--End Invoice-->
    </div><!-- End Invoice Holder-->
</body>

</html>
