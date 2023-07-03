@extends('layouts.master')
@section('title', 'Gestion  Depense')

@section('title_toolbar', 'La liste des  Depenses')
@section('subtitle_toolbar', 'Gestion des  Depenses')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('depenses.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Depense
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
                            <a  href="{{route('depenses.pdftable')}}"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('depenses.exportdepense')}}"><img
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
                            <th>Ref</th>
                            <th>Motif</th>
                            <th>Montant</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $expense)
                        <tr>
                            {{-- <td>
                                <label class="checkboxs">
                                    <input type="checkbox" value="{{$expense->id}}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td> --}}
                            <td>
                               {{$expense->number_expense}}
                            </td>
                            <td>{{$expense->reason}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->typeexpense->name_expense_types}}</td>
                            <td>{{$expense->created_at->format('d-m-Y')}}</td>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('depenses.show',  $expense->id) }}" class="dropdown-item"><img
                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img" />Détail</a>
                                </li>
                                <li>
                                    <a href="{{ route('depenses.edit',  $expense->id) }}" class="dropdown-item"><img
                                            src="assets/img/icons/edit.svg" class="me-2" alt="img" />Éditer</a>
                                </li>
                                <li>
                                    <form class="delete-item d-inline" method="post"
                                        action="{{ route('depenses.delete',  $expense->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item">
                                            <img src="assets/img/icons/delete1.svg" class="me-2" alt="img" />
                                            <input style="border:none;background:transparent" type="submit"
                                                value="Supprimer">
                                        </button>
                                    </form>
                                </li>
                            </ul>
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
