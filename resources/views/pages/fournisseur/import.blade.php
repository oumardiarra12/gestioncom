@extends('layouts.master')
@section('title', 'Gestion Fournisseur')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Import Fournisseur')
@section('subtitle_toolbar', 'Gestion des Fournisseurs')
@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('fournisseurs.index') }}" class="btn btn-outline-warning"><img
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
                <form method="POST" action="{{ route('fournisseurs.storefournisseur') }}" enctype="multipart/form-data" id="importsupplyform">
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
                            <input type="file" name="importfournisseur">
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
                                <h4>Nom Societe</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Telephone Societe</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire </h6>
                            </li>
                            <li>
                                <h4>Adresse Societe</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Email Societe</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Nom de Contact</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Prenom de Contact</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Telephone de Contact</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Email de Contact</h4>
                                <h6 class="manitorygreen">Ce champ est obligatoire</h6>
                            </li>
                            <li>
                                <h4>Description</h4>
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
            $("#importsupplyform").validate({
                rules: {
                    importfournisseur: "required",
                },
                messages: {
                    importfournisseur: {
                        required: "import file is required"
                    }

                }
            });
        });
    </script>
@endsection
