@extends('layouts.masterpos')
@section('title', 'Gestion POS')

@section('title_toolbar', 'Show POS')
@section('subtitle_toolbar', 'Gestion des Vente')
@section('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .container {
            display: block;
            width: 100%;
            background: #fff;
            max-width: 350px;
            padding: 25px;
            margin: 50px auto 0;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        }

        .receipt_header {
            padding-bottom: 40px;
            border-bottom: 1px dashed #000;
            text-align: center;
        }

        .receipt_header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .receipt_header h1 span {
            display: block;
            font-size: 25px;
        }

        .receipt_header h2 {
            font-size: 14px;
            color: #727070;
            font-weight: 300;
        }

        .receipt_header h2 span {
            display: block;
        }

        .receipt_body {
            margin-top: 25px;
        }

        table {
            width: 100%;
        }

        thead,
        tfoot {
            position: relative;
        }

        thead th:not(:last-child) {
            text-align: left;
        }

        thead th:last-child {
            text-align: right;
        }

        thead::after {
            content: '';
            width: 100%;
            border-bottom: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tbody td:not(:last-child),
        tfoot td:not(:last-child) {
            text-align: left;
        }

        tbody td:last-child,
        tfoot td:last-child {
            text-align: right;
        }

        tbody tr:first-child td {
            padding-top: 15px;
        }

        tbody tr:last-child td {
            padding-bottom: 15px;
        }

        tfoot tr:first-child td {
            padding-top: 15px;
        }

        tfoot::before {
            content: '';
            width: 100%;
            border-top: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tfoot tr:first-child td:first-child,
        tfoot tr:first-child td:last-child {
            font-weight: bold;
            font-size: 20px;
        }

        .date_time_con {
            display: flex;
            justify-content: center;
            column-gap: 25px;
        }

        .items {
            margin-top: 25px;
        }

        h3 {
            border-top: 1px dashed #000;
            padding-top: 10px;
            margin-top: 25px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="container">
        <div class="receipt_header">
            <h1>Ticket <span>{{ $company->company_name }}</span></h1>
            <h2>Addresse: {{ $company->company_address }} <span>Tel: {{ $company->company_contact }}</span></h2>
        </div>

        <div class="receipt_body">

            <div class="date_time_con">
                <div class="date"> {{ date('m/d/Y') }}</div>
                <div class="time">{{ date('H:i:s') }} AM</div>
            </div>

            <div class="items">
                <table>

                    <thead>
                        <th>QTE</th>
                        <th>DESIGNATION</th>
                        <th>SOUS TOTAL</th>
                    </thead>

                    <tbody>
                        @foreach ($lignecomptoirs as $lignecomptoir)
                            <tr>
                                <td>{{ $lignecomptoir->qty_linecomptoir }}</td>
                                <td>{{ $lignecomptoir->product->name_product }}</td>
                                <td>{{ $lignecomptoir->subtotal_linecomptoir }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td>{{ $comptoir->total_comptoir }}</td>
                        </tr>

                        {{-- <tr>
                        <td>Cash</td>
                        <td></td>
                        <td>32.1</td>
                    </tr>

                    <tr>
                        <td>Change</td>
                        <td></td>
                        <td>32.1</td>
                    </tr> --}}
                    </tfoot>

                </table>
            </div>

        </div>


        <h3>Thank You!</h3>

    </div>
    <div class="d-flex justify-content-around">
        <a href="{{ route('comptoirs.create') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
        <a class="btnprint" data-bs-toggle="tooltip" data-bs-placement="top" href="{{route('comptoirs.pdfcomptoir',$comptoir->id)}}" title="pdf"><img
                src="assets/img/icons/pdf.svg" alt="img"></a>
    </div>
@endsection
{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.btnprint').click(function() {
                $('.container').printThis();
            });
        });
    </script>
@endsection --}}
