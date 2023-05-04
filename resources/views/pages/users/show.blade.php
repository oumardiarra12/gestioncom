@extends('layouts.master')
@section('title', "Détail de l'utilisateur")

@section('title_toolbar', "Détail de l'Utilisateur")
@section('subtitle_toolbar', 'Gestion des Utilisateurs')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('utilisateur.index') }}" class="btn btn-outline-warning"><img
                src="{{ asset('assets/img/icons/return1.svg') }}" alt="img" class="me-1"></a>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="profile-set">
                <div class="profile-head">
                </div>
                <div class="profile-top">
                    <div class="profile-content">
                        <div class="profile-contentimg rounded-sm" >
                            <img src="users/{{$user->image}}" alt="img" id="blah" >
                        </div>
                        <div class="profile-contentname">
                            <h2>{{$user->firstname}} {{$user->lastname}}</h2>
                            <h4>{{$user->CategoryUser->name_category_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Nom</label>
                        <span>{{$user->firstname}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Prenom</label>
                        <span>{{$user->lastname}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Email</label>
                        <span>{{$user->email}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Telephone</label>
                        <span>{{$user->telephone}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Categorie</label>
                        <span>{{$user->CategoryUser->name_category_users}}</span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Adresse</label>
                        <div class="pass-group">
                            <span>{{$user->addresse}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                <a href="{{route('utilisateur.index')}}" class="btn btn-submit me-2">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
