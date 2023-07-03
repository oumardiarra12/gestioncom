@extends('layouts.master')
@section('title', 'Gestion Depense')

@section('title_toolbar', 'Show Depense')
@section('subtitle_toolbar', 'Gestion des Depenses')
@section('subtitle_toolbar', 'Gestion des Depenses')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('depenses.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-sales-split">
                <ul>
                    <li>
                        <a href="{{ route('depenses.depensepdf', $expense->id) }}"><img
                                src="assets/img/icons/pdf.svg" alt="img"></a>
                    </li>
                </ul>
            </div>
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td>Reference No:</td>
                            <td>{{$expense->number_expense}}</td>
                        </tr>
                        <tr>
                            <td>Date:</td>
                            <td>{{$expense->created_at->format('d-m-Y')}}</td>
                        </tr>
                        <tr>
                            <td>Type de Depense:</td>
                            <td>{{$expense->typeexpense->name_expense_types}} </td>
                        </tr>
                        <tr>
                            <td>Montant:</td>
                            <td>{{$expense->amount}} </td>
                        </tr>
                        <tr>
                            <td>Motif: </td>
                            <td>{{$expense->reason}}</td>
                        </tr>
                        <tr><td>Description:</td>
                            <td><p>{{$expense->description_expense}}</p></td>
                        </tr>
                    </table>
                </div>

        </div>
    </div>
@endsection
