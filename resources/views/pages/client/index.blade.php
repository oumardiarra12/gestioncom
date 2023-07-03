@extends('layouts.master')
@section('title', 'Gestion Clients')

@section('title_toolbar', 'La liste des Clients')
@section('subtitle_toolbar', 'Gestion des Clients')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('clients.createclient') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Client
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
                            <a href="{{route('clients.pdftable')}}"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('clients.exportclient')}}"><img
                                    src="assets/img/icons/excel.svg" alt="img"></a>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="card" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" name="firstname_customer" placeholder="Entre le Nom de Client" id="firstname_customer" onkeyup="searchFirstname()">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" name="address_customer" placeholder="Entre le Adresse de Client" id="address_customer" onkeyup="searchAdress()">
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
                <table class="table datanew" id="customerTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>Nom Client</th>
                            <th>Prenom Client</th>
                            <th>Tel Client</th>
                            <th>Email Client</th>
                            <th>Adresse Client</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            {{-- <td>
                                <label class="checkboxs">
                                    <input type="checkbox" value="{{$supplier->id}}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td> --}}
                            <td>{{$customer->firstname_customer}}</td>
                            <td>{{$customer->lastname_customer}}</td>
                            <td>{{$customer->tel_customer}}</td>
                            <td>{{$customer->email_customer}}</td>
                            <td>{{$customer->address_customer}}</td>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('clients.show',  $customer->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/eye1.svg" class="me-2" alt="img" />Détail</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('clients.edit',  $customer->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/edit.svg" class="me-2" alt="img" />Éditer</a>
                                    </li>
                                    <li>
                                        <form class="delete-item d-inline" method="post"
                                            action="{{ route('clients.delete',  $customer->id) }}">
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
    function searchFirstname() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("firstname_customer");
      filter = input.value.toUpperCase();
      table = document.getElementById("customerTable");
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
    function searchAdress() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("address_customer");
      filter = input.value.toUpperCase();
      table = document.getElementById("customerTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
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
