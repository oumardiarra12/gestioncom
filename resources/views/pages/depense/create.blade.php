@extends('layouts.master')
@section('title', 'Gestion  Depense')

@section('title_toolbar', 'Nouveau Depense')
@section('subtitle_toolbar', 'Gestion des Depenses')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('depenses.store') }}" id="form">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Type de Depense</label>
                            <select class="select" name="expense_types_id" @error("expense_types_id") is-invalid @enderror>
                                <option selected="true" disabled="true">Choisir Type de depense</option>
                               @foreach ($expensetypes as $expensetype)
                               <option value="{{$expensetype->id}}">{{$expensetype->name_expense_types}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Amount</label>
                            <div class="input-groupicon">
                                <input type="text" name="amount" @error('amount') is-invalid @enderror>
                                <div class="addonset">
                                    <img src="assets/img/icons/dollar.svg" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Motif de Depense</label>
                            <input type="text" name="reason" @error('reason') is-invalid @enderror>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_expense" @error('description_expense') is-invalid @enderror ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('depenses.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
