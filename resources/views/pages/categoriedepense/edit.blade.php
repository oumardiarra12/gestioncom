@extends('layouts.master')
@section('title', 'Gestion Type Depense')

@section('title_toolbar', 'Edit Type Depense')
@section('subtitle_toolbar', 'Gestion des Types Depenses')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('typedepenses.update',$expensetype->id) }}">
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
                            <label>Nom de Type</label>
                            <input type="text" name="name_expense_types" value="{{$expensetype->name_expense_types}}" id="name_expense_types">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description_expense_types">{{$expensetype->description_expense_types}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button  class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('typedepenses.index') }}" class="btn btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
