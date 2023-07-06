@extends('layouts.master')
@section('title', 'Gestion Produit')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Import Produit')
@section('subtitle_toolbar', 'Gestion des Produits')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('produits.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="requiredfield">
                <h4>Le champ doit être au format csv</h4>
            </div>
            <div class="row">
                <form method="POST" action="{{ route('produits.storeproduit') }}" enctype="multipart/form-data" id="importproductform">
                <div class="col-lg-12">
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
                    <div class="form-group">
                        <label> Télécharger le fichier CSV</label>
                        <div class="image-upload">
                            <input type="file" name="importproduit">
                            <div class="image-uploads">
                                <img src="assets/img/icons/upload.svg" alt="img">
                                <h4>Faites glisser et déposez un fichier à télécharger</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="productdetails productdetailnew">
                        <ul class="product-bar">
                            <li>
                                <h4>Nom Produit</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Categorie</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire ou Ce champ doit etre numerique</h6>
                            </li>
                            <li>
                                <h4>Code Barre</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire ou Ce champ doit etre numerique 12 caractres</h6>
                            </li>
                            <li>
                                <h4>Prix Vente</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Prix Achat</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Unite</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
                                <h6 class="manitoryblue">Champ facultatif</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="productdetails productdetailnew">
                        <ul class="product-bar">
                            <li>
                                <h4>Stock Minimum</h4>
                                <h6 class="manitoryblue">Champ facultatif</h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-0">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#importproductform").validate({
                rules: {
                    importproduit: "required",
                },
                messages: {
                    importproduit: {
                        required: "import file is required"
                    }

                }
            });
        });
    </script>
@endsection
