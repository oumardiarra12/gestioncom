@extends('layouts.master')
@section('title', 'Gestion Retour Ventes')

@section('title_toolbar', 'La liste des Retour Ventes')
@section('subtitle_toolbar', 'Gestion des Retour Ventes')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('retournventes.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Retour Vente
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
                            <a href="{{ route('retournventes.pdftable') }}"><img src="assets/img/icons/pdf.svg"
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
                                <input type="text" name="num_return_customer" placeholder="Entre le Numero de Retour Vente"
                                    id="num_return_customer" onkeyup="searchNumRetourCustomer()">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="customer" onchange="searchCustomer()">
                                    <option selected="true" disabled="true">Filtre par Client</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->firstname_customer }}">{{ $customer->firstname_customer }} {{ $customer->lastname_customer }}
                                        </option>
                                    @endforeach

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
                <table class="table datanew" id="returncustomerTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>No Retour Vente</th>
                            <th>Total</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returncustomers as $returncustomer)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $returncustomer->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{ $returncustomer->num_return_customer }}</td>
                                <td>{{ $returncustomer->total_return_customer }}</td>
                                <td>{{ $returncustomer->customer->firstname_customer }} {{ $returncustomer->customer->lastname_customer }}</td>
                                <td>{{ $returncustomer->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('retournventes.show', $returncustomer->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                            <li>
                                                <a href="{{ route('retournventes.edit', $returncustomer->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Éditer</a>
                                            </li>
                                            <li>
                                                <form class="delete-item d-inline" method="post"
                                                    action="{{ route('retournventes.delete', $returncustomer->id) }}">
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
        function searchNumRetourCustomer() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_return_customer");
            filter = input.value.toUpperCase();
            table = document.getElementById("returncustomerTable");
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

        function searchCustomer() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("customer");
            filter = input.value.toUpperCase();
            table = document.getElementById("returncustomerTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
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
