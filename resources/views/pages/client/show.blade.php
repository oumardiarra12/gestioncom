@extends('layouts.master')
@section('title', 'Gestion Client')

@section('title_toolbar', 'Detail Client')
@section('subtitle_toolbar', 'Gestion des Clients')
@section('btn_add_item')
<div class="page-btn">
    <a href="{{ route('clients.index') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Nom Client</h4>
                                <h6>{{$customer->firstname_customer}} </h6>
                            </li>
                            <li>
                                <h4>Prenom Client</h4>
                                <h6>{{$customer->lastname_customer}}</h6>
                            </li>
                            <li>
                                <h4>Tel Client</h4>
                                <h6>{{$customer->tel_customer}}</h6>
                            </li>
                            <li>
                                <h4>Email Client</h4>
                                <h6>{{$customer->email_customer}}</h6>
                            </li>
                            <li>
                                <h4>Adresse Client</h4>
                                <h6>{{$customer->address_customer}}</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6>{{$customer->address_customer}}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
