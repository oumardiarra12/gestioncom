@extends('layouts.master')
@section('title', 'Gestion Categorie')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Edit Categorie')
@section('subtitle_toolbar', 'Gestion des Categories')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('categories.update',$categorie->id) }}" id="editcategoryform">
                @method('put')
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
                            <input type="text" name="name_category" value="{{$categorie->name_category}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_category">{{$categorie->description_category}}</textarea>
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
@section('script')
    <script>
        $(document).ready(function() {
            $("#editcategoryform").validate({
                rules: {
                    name_category: "required",
                },
                messages: {
                    name_category: {
                        required: "Category name is required"
                    }

                }
            });
        });
    </script>
@endsection
