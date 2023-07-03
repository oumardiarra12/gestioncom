@extends('layouts.master')
@section('title', 'Gestion Commande Ventes')

@section('title_toolbar', 'La liste des Commande Ventes')
@section('subtitle_toolbar', 'Gestion des Commande Ventes')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('commandeventes.createcmdvente') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Commande Vente
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
                            <a href="{{ route('commandeventes.pdftable') }}"><img src="assets/img/icons/pdf.svg"
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
                                <input type="text" name="num_customer_order" placeholder="Entre le Numero de Commande"
                                    id="num_customer_order" onkeyup="searchNumCustomerOrder()">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="customer" onchange="searchCustomer()">
                                    <option selected disabled hidden>----</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->firstname_customer }}">{{ $customer->firstname_customer }} {{ $customer->lastname_customer }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="status_customer_order" onchange="searchStatuscustomerorder()">
                                    <option selected disabled hidden>----</option>
                                    <option value="in progress">En Cours</option>
                                    <option value="delivery">Livraison</option>
                                    <option value="biased delivery">Une Partie Livraison</option>
                                    <option value="cancel">Annuler</option>
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
                <table class="table datanew" id="customerOrderTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>No Commande</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customereorders as $customereorder)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $customereorder->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{$customereorder->num_customer_order }}</td>
                                <td>{{ $customereorder->total_customer_order }}</td>
                                <td @if($customereorder->status_customer_order =='in progress')  style="color: red;" @elseif ($customereorder->status_customer_order=="biased delivery") style="color: yellow;" @else style="color: green;" @endif>{{ $customereorder->status_customer_order }}</td>
                                <td>{{ $customereorder->customer->firstname_customer }} {{ $customereorder->customer->lastname_customer }}</td>
                                <td>{{ $customereorder->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('commandeventes.show', $customereorder->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                        @if ($customereorder->status_customer_order  == 'in progress' || $customereorder->status_customer_order  == 'biased delivery' )
                                        <li>
                                            <a href="{{ route('commandeventes.createdelivery', $customereorder->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/sales1.svg" class="me-2"
                                                    alt="img" />Livraison</a>
                                        </li>
                                        @endif
                                        @if ($customereorder->status_customer_order == 'in progress')

                                            <li>
                                                <a href="{{ route('commandeventes.edit', $customereorder->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Éditer</a>
                                            </li>
                                            <li>
                                                <form class="delete-item d-inline" method="post"
                                                    action="{{ route('commandeventes.delete', $customereorder->id) }}">
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
        function searchNumCustomerOrder() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_customer_order");
            filter = input.value.toUpperCase();
            table = document.getElementById("customerOrderTable");
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
            table = document.getElementById("customerOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[3];
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

        function searchStatuscustomerorder() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("status_customer_order");
            filter = input.value.toUpperCase();
            table = document.getElementById("customerOrderTable");
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
