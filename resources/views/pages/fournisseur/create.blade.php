@extends('layouts.master')
@section('title', 'Gestion Fournisseur')

@section('title_toolbar', 'Nouveau Fournisseur')
@section('subtitle_toolbar', 'Gestion desFournisseurs')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST"  action="{{ route('fournisseurs.store') }}" id="form">
                @csrf
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nom Societe</label>
                            <input type="text" name="name_supplier" id="name_supplier">
                        </div>
                        <div class="form-group">
                            <label>Tel Societe</label>
                            <input type="number" name="tel_supplier" id="tel_supplier">
                        </div>
                        <div class="form-group">
                            <label>Email Societe</label>
                            <input type="email" name="email_supplier" id="email_supplier">
                        </div>
                        <div class="form-group">
                            <label>Adresse Societe</label>
                            <input type="text" name="address_supplier" id="address_supplier">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Prenom de Contact</label>
                            <input type="text" name="firstname_contact_supplier" id="firstname_contact_supplier">
                        </div>
                        <div class="form-group">
                            <label>Nom de Contact</label>
                            <input type="text" name="lastname_contact_supplier" id="lastname_contact_supplier">
                        </div>
                        <div class="form-group">
                            <label>Tel de Contact</label>
                            <input type="text" name="tel_contact_supplier" id="tel_contact_supplier">
                        </div>
                        <div class="form-group">
                            <label>Email de Contact</label>
                            <input type="text" name="email_contact_supplier" id="email_contact_supplier">
                        </div>
                        {{-- <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="email_contact_supplier"></textarea>
                        </div> --}}
                    </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_supplier"></textarea>
                        </div>

                    <div class="col-lg-12">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('fournisseurs.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

