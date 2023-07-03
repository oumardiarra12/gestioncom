@extends('layouts.master')
@section('title', 'Gestion Livraison')

@section('title_toolbar', 'La liste des Livraisons')
@section('subtitle_toolbar', 'Gestion des Livraisons')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('livraisons.createlivraison') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter une Livraison Direct
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
                            <a href="{{ route('livraisons.pdftable') }}"><img src="assets/img/icons/pdf.svg"
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
                                <input type="text" name="num_deliveries" placeholder="Entre le Numero de Livraison"
                                    id="num_deliveries" onkeyup="searchNumLivraison()">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="js-example-basic-single select2" id="status_deliveries" onchange="searchStatusLivraison()">
                                    <option selected="true" disabled="true">Filtre par status</option>
                                    <option value="no invoice">Non Facture</option>
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
                <table class="table datanew" id="livraisonTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>No Livraison</th>
                            <th>Status</th>
                            <th>Commande Vente</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliveries as $delivery)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $delivery->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{ $delivery->num_deliveries }}</td>
                                <td @if($delivery->status_deliveries =='no invoice')  style="color: red;" @else style="color: green;" @endif>{{ $delivery->status_deliveries }}</td>
                                <td>{{ $delivery->customer_order->num_customer_order ?? 'pas de commande' }}</td>
                                <td>{{$delivery->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('livraisons.show', $delivery->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                        @if ($delivery->status_deliveries =='no invoice')
                                            <li>
                                                <a href="{{ route('livraisons.edit', $delivery->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                        class="me-2" alt="img" />Éditer</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('ventefactures.create', $delivery->id) }}"
                                                    class="dropdown-item"><img src="assets/img/icons/purchase1.svg"
                                                        class="me-2" alt="img" />Facturer</a>
                                            </li>
                                            <li>
                                                <form class="delete-item d-inline" method="post"
                                                    action="{{ route('livraisons.delete', $delivery->id) }}">
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
        function searchNumLivraison() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_deliveries");
            filter = input.value.toUpperCase();
            table = document.getElementById("livraisonTable");
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

        function searchStatusLivraison() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("status_deliveries");
            filter = input.value.toUpperCase();
            table = document.getElementById("livraisonTable");
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
