@extends('layouts.master')
@section('title', 'Gestion Unite')
@section('style')
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
@endsection
@section('title_toolbar', 'Edit Unite')
@section('subtitle_toolbar', 'Gestion des Unites')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('unites.update',$unite->id) }}" id="editunitform">
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
                            <label>Nom Unite</label>
                            <input type="text" name="name_unit" value="{{$unite->name_unit}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_unit">{{$unite->description_unit}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('utilisateur.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#editunitform").validate({
                rules: {
                    name_unit: "required",
                },
                messages: {
                    name_unit: {
                        required: "Unit name is required"
                    }

                }
            });
        });
    </script>
@endsection
