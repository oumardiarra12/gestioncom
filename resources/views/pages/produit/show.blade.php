@extends('layouts.master')
@section('title', 'Gestion Produit')

@section('title_toolbar', 'Detail Produit')
@section('subtitle_toolbar', 'Gestion des Produits')
@section('btn_add_item')
<div class="page-btn">
    <a href="{{ route('produits.index') }}" class="btn btn-outline-warning"><img
            src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
</div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="bar-code-view">
                        <div class="mb-3">{!! DNS1D::getBarcodeHTML($produit->codebarre_product, 'CODABAR') !!}</div>
                        <a class="printimg">
                            <img src="assets/img/icons/printer.svg" alt="print">
                        </a>
                    </div>
                    <div class="productdetails">
                        <ul class="product-bar">
                            <li>
                                <h4>Nom Produit</h4>
                                <h6>{{$produit->name_product}} </h6>
                            </li>
                            <li>
                                <h4>Categorie</h4>
                                <h6>{{$produit->category->name_category}}</h6>
                            </li>
                            <li>
                                <h4>Unite</h4>
                                <h6>{{$produit->unit->name_unit}}</h6>
                            </li>
                            <li>
                                <h4>Prix Vente</h4>
                                <h6>{{$produit->price_sale}}</h6>
                            </li>
                            <li>
                                <h4>Prix Achat</h4>
                                <h6>{{$produit->price_purchase}}</h6>
                            </li>
                            <li>
                                <h4>SKU</h4>
                                <h6>{{$produit->ref_product}}</h6>
                            </li>
                            <li>
                                <h4>Stock Min</h4>
                                <h6>{{$produit->stock_min}}</h6>
                            </li>
                            <li>
                                <h4>Stock Actuel</h4>
                                <h6>{{$produit->stock_actuel}}</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6>{{$produit->description_product}}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <img src="/storage/imageproduits/{{$produit->image_product}}" alt="img">
                </div>
            </div>
        </div>
    </div>
@endsection
