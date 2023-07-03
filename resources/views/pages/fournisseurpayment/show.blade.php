@extends('layouts.master')
@section('title', 'Gestion Facture Achat')

@section('title_toolbar', 'Detail Facture Achat')
@section('subtitle_toolbar', 'Gestion des Facture Achats')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('achatfactures.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bon de Paiement Fournisseur</h5>
            <h6 class="card-subtitle mb-2 text-muted d-flex justify-content-between"><span>Ref.:{{$supplierpayment->num_supplier_payment}}</span><span>Date: {{$supplierpayment->created_at}}</span></h6>
            <table class="table table-bordered">
                <tr>
                    <td>Montant a Payer:</td>
                    <td>{{$supplierpayment->amount_to_be_paid}}</td>
                </tr>
                {{-- <tr><td>Date:</td>
                    <td>{{$supplierpayment->created_at}}</td></tr> --}}
                <tr>
                    <td>Montant Payer:</td>
                    <td>{{$supplierpayment->amount_to_pay}} </td>
                </tr>
                <tr>
                    <td>Reste: </td>
                    <td>{{$supplierpayment->reste}}</td>
                </tr>
                <tr><td>Description:</td>
                    <td><p>{{$supplierpayment->description_supplier_payment}}</p></td>
                </tr>
            </table>

        </div>
        <div class="page-btn d-flex justify-content-end m-2">
            <a href="{{ route('supplierpayements.supplierpayementpdf',$supplierpayment->id) }}" class="btn btn-outline-warning"><img
                    src="{{ asset('assets/img/icons/printer.svg') }}" alt="img" class="me-1"></a>
        </div>
    </div>
@endsection

