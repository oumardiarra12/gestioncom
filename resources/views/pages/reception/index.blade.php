@extends('layouts.master')
@section('title', 'Gestion Reception')

@section('title_toolbar', 'La liste des Receptions')
@section('subtitle_toolbar', 'Gestion des Receptions')

{{-- @section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('receptions.createreception') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Reception Direct
        </a>
    </div>
@endsection --}}

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
                            <a href="{{ route('receptions.pdftable') }}"><img src="assets/img/icons/pdf.svg"
                                    alt="img"></a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" name="num_reception" placeholder="Entre le Numero de Reception"
                                    id="num_reception" onkeyup="searchNumReception()">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="statusreception" onchange="searchStatusreception()">
                                    <option selected="true" disabled="true">Filtre par status</option>
                                    <option value="non invoice">Non Facture</option>
                                    <option value="to invoice">Facturer</option>
                                </select>
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
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="receptionTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>No Reception</th>
                            <th>Status</th>
                            <th>Commande Achat</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receptions as $reception)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $reception->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{ $reception->num_reception }}</td>
                                <td @if($reception->status_reception =='non invoice')  style="color: red;" @else style="color: green;" @endif>{{ $reception->status_reception }}</td>
                                <td>{{ $reception->purchase_order->num_purchase_order ?? 'pas de commande' }}</td>
                                <td>{{$reception->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('receptions.show', $reception->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                        @if ($reception->status_reception =='non invoice')
                                            <li>
                                                <a href="{{ route('receptions.edit', $reception->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Éditer</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('achatfactures.create', $reception->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Facturer</a>
                                            </li>
                                            <li>
                                                <form class="delete-item d-inline" method="post"
                                                    action="{{ route('receptions.delete', $reception->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item">
                                                        <img src="assets/img/icons/delete1.svg" class="me-2"
                                                            alt="img" />
                                                        <input style="border:none;background:transparent" type="submit"
                                                            value="Supprimer">
                                                    </button>
                                                </form>
                                            </li>
                                            @endif

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
        function searchNumReception() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_reception");
            filter = input.value.toUpperCase();
            table = document.getElementById("receptionTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchStatusreception() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("statusreception");
            filter = input.value.toUpperCase();
            table = document.getElementById("receptionTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
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
