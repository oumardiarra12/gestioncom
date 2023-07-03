@extends('layouts.master')
@section('title', 'Gestion Client')

@section('title_toolbar', 'Nouveau Client')
@section('subtitle_toolbar', 'Gestion des Clients')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST"  action="{{ route('clients.store') }}" id="form">
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
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Nom Client</label>
                            <input type="text" name="firstname_customer" id="firstname_customer">
                        </div>
                        <div class="form-group">
                            <label>Prenom Client</label>
                            <input type="text" name="lastname_customer" id="lastname_customer">
                        </div>
                        <div class="form-group">
                            <label>Telephone Client</label>
                            <input type="number" name="tel_customer" id="tel_customer">
                        </div>
                        <div class="form-group">
                            <label>Email Client</label>
                            <input type="email" name="email_customer" id="email_customer">
                        </div>
                        <div class="form-group">
                            <label>Adresse Client</label>
                            <input type="text" name="address_customer" id="address_customer">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_customer"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

