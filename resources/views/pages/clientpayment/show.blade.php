@extends('layouts.master')
@section('title', 'Gestion Client Paiement')

@section('title_toolbar', 'Detail Client Paiement')
@section('subtitle_toolbar', 'Gestion des Client Paiements')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('ventefactures.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bon de Paiement Client</h5>
            <h6 class="card-subtitle mb-2 text-muted d-flex justify-content-between"><span>Ref.:{{$customerpayment->num_customer_payment}}</span><span>Date: {{$customerpayment->created_at}}</span></h6>
            <table class="table table-bordered">
                <tr>
                    <td>Montant a Payer:</td>
                    <td>{{$customerpayment->amount_to_be_paid}}</td>
                </tr>
                {{-- <tr><td>Date:</td>
                    <td>{{$supplierpayment->created_at}}</td></tr> --}}
                <tr>
                    <td>Montant Payer:</td>
                    <td>{{$customerpayment->amount_to_pay}} </td>
                </tr>
                <tr>
                    <td>Reste: </td>
                    <td>{{$customerpayment->reste}}</td>
                </tr>
                <tr><td>Description:</td>
                    <td><p>{{$customerpayment->description_customer_payment}}</p></td>
                </tr>
            </table>

        </div>
        <div class="page-btn d-flex justify-content-end m-2">
            <a href="{{ route('customerpayements.customerpayementpdf',$customerpayment->id) }}" class="btn btn-outline-warning"><img
                    src="{{ asset('assets/img/icons/printer.svg') }}" alt="img" class="me-1"></a>
        </div>
    </div>
@endsection

