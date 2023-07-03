@extends('layouts.master')
@section('title', 'Gestion Categorie')

@section('title_toolbar', 'Nouveau Categorie')
@section('subtitle_toolbar', 'Gestion des Categories')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST"  action="{{ route('categories.store') }}" id="form">
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
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Categorie</label>
                            <input type="text" name="name_category" id="name_category">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_category"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

