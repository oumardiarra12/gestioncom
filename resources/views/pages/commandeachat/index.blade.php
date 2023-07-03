@extends('layouts.master')
@section('title', 'Gestion Commande Achats')

@section('title_toolbar', 'La liste des Commande Achats')
@section('subtitle_toolbar', 'Gestion des Commande Achats')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('commandeachats.createcmdachat') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Commande Achat
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
                            <a href="{{ route('commandeachats.pdftable') }}"><img src="assets/img/icons/pdf.svg"
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
                                <input type="text" name="num_purchase_order" placeholder="Entre le Numero de Commande"
                                    id="num_purchase_order" onkeyup="searchNumPurchaseOrder()">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="supplier" onchange="searchSupplier()">
                                    <option selected disabled hidden>----</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->name_supplier }}">{{ $supplier->name_supplier }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="statuspurchaseorder" onchange="searchStatuspurchaseorder()">
                                    <option selected disabled hidden>----</option>
                                    <option value="in progress">En Cours</option>
                                    <option value="receipt">Receptionner</option>
                                    <option value="biased receipt">Une Partie Receptionner</option>
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
                <table class="table datanew" id="purchaseOrderTable">
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
                            <th>Fournisseur</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseorders as $purchaseorder)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $purchaseorder->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{ $purchaseorder->num_purchase_order }}</td>
                                <td>{{ $purchaseorder->total_purchase_order }}</td>
                                <td @if($purchaseorder->stats_purchase_order =='in progress')  style="color: red;" @elseif ($purchaseorder->stats_purchase_order=="biased receipt") style="color: yellow;" @else style="color: green;" @endif>{{ $purchaseorder->stats_purchase_order }}</td>
                                <td>{{ $purchaseorder->supplier->name_supplier }}</td>
                                <td>{{ $purchaseorder->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('commandeachats.show', $purchaseorder->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                        @if ($purchaseorder->stats_purchase_order == 'in progress' || $purchaseorder->stats_purchase_order == 'biased receipt' )
                                        <li>
                                            <a href="{{ route('commandeachats.createrecept', $purchaseorder->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Reception</a>
                                        </li>
                                        @endif
                                        @if ($purchaseorder->stats_purchase_order == 'in progress')

                                            <li>
                                                <a href="{{ route('commandeachats.edit', $purchaseorder->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Éditer</a>
                                            </li>
                                            <li>
                                                <form class="delete-item d-inline" method="post"
                                                    action="{{ route('commandeachats.delete', $purchaseorder->id) }}">
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
        function searchNumPurchaseOrder() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_purchase_order");
            filter = input.value.toUpperCase();
            table = document.getElementById("purchaseOrderTable");
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

        function searchSupplier() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("supplier");
            filter = input.value.toUpperCase();
            table = document.getElementById("purchaseOrderTable");
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

        function searchStatuspurchaseorder() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("statuspurchaseorder");
            filter = input.value.toUpperCase();
            table = document.getElementById("purchaseOrderTable");
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
