@extends('layouts.master')
@section('title', 'Gestion Type Depense')

@section('title_toolbar', 'La liste des Types Depenses')
@section('subtitle_toolbar', 'Gestion des Types Depenses')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('typedepenses.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Type Depense
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <img src="assets/img/icons/filter.svg" alt="img">
                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                        </a>
                    </div>
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a  href="{{route('typedepenses.pdftable')}}"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('typedepenses.exporttypedepense')}}"><img
                                    src="assets/img/icons/excel.svg" alt="img"></a>
                        </li>

                    </ul>
                </div>
            </div>

            {{-- <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Brand Name">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Brand Description">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                            <div class="form-group">
                                <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                        alt="img"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>ID</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expensetypes as $expensetype)
                        <tr>
                            {{-- <td>
                                <label class="checkboxs">
                                    <input type="checkbox" value="{{$expensetype->id}}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td> --}}
                            <td>
                               {{$expensetype->id}}
                            </td>
                            <td>{{$expensetype->name_expense_types}}</td>
                            <td>
                                <a class="me-3" href="{{route('typedepenses.edit',$expensetype->id)}}">
                                    <img src="assets/img/icons/edit.svg" alt="img">
                                </a>

                                    <form class="delete-item d-inline confirm-text" method="post"
                                            action="{{ route('typedepenses.delete', $expensetype->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-rounded btn-light">
                                                <img src="assets/img/icons/delete.svg" alt="img">
                                            </button>
                                        </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });

    </script>
@endsection
