@extends('layouts.master')
@section('title', 'Gestion Fournisseur')

@section('title_toolbar', 'Detail Fournisseur')
@section('subtitle_toolbar', 'Gestion des Fournisseurs')
@section('btn_add_item')
<div class="page-btn">
    <a href="{{ route('fournisseurs.index') }}" class="btn btn-outline-warning"><img
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
                                <h4>Nom Societe</h4>
                                <h6>{{$supplier->name_supplier}} </h6>
                            </li>
                            <li>
                                <h4>Tel Societe</h4>
                                <h6>{{$supplier->tel_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Adresse Societe</h4>
                                <h6>{{$supplier->address_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Email Societe</h4>
                                <h6>{{$supplier->email_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Nom Complet de Contact</h4>
                                <h6>{{$supplier->firstname_contact_supplier}}--{{$supplier->lastname_contact_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Telephone Contact</h4>
                                <h6>{{$supplier->tel_contact_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Email Contact</h4>
                                <h6>{{$supplier->email_contact_supplier}}</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6>{{$supplier->address_supplier}}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
