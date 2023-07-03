@extends('layouts.master')
@section('title', 'Gestion Fournisseurs')

@section('title_toolbar', 'La liste des Fournisseurs')
@section('subtitle_toolbar', 'Gestion desFournisseurs')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('fournisseurs.createfournisseur') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Fournisseur
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
                            <a href="{{route('fournisseurs.pdftable')}}"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a href="{{route('fournisseurs.exportfournisseur')}}"><img
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
                                <input type="text" name="name_supplier" placeholder="Entre le Nom de Societe" id="name_supplier" onkeyup="searchNameSociete()">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <input type="text" name="firstname_contact_supplier" placeholder="Entre le Nom de Contact chez le Fournisseur" id="firstname_contact_supplier" onkeyup="searchNameContact()">
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
                <table class="table datanew" id="supplierTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>Nom Societe</th>
                            <th>Tel Societe</th>
                            {{-- <th>Email Societe</th> --}}
                            <th>Nom de Contact</th>
                            <th>Tel de Contact</th>
                            <th>Email de Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr>
                            {{-- <td>
                                <label class="checkboxs">
                                    <input type="checkbox" value="{{$supplier->id}}">
                                    <span class="checkmarks"></span>
                                </label>
                            </td> --}}
                            <td>{{$supplier->name_supplier}}</td>
                            <td>{{$supplier->tel_supplier}}</td>
                            {{-- <td>{{$supplier->email_supplier}}</td> --}}
                            <td>{{$supplier->firstname_contact_supplier}}-{{$supplier->lastname_contact_supplier}}</td>
                            <td>{{$supplier->tel_contact_supplier}}</td>
                            <td>{{$supplier->email_contact_supplier}}</td>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('fournisseurs.show',  $supplier->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/eye1.svg" class="me-2" alt="img" />Détail</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('fournisseurs.edit',  $supplier->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/edit.svg" class="me-2" alt="img" />Éditer</a>
                                    </li>
                                    <li>
                                        <form class="delete-item d-inline" method="post"
                                            action="{{ route('fournisseurs.delete',  $supplier->id) }}">
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
    function searchNameSociete() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("name_supplier");
      filter = input.value.toUpperCase();
      table = document.getElementById("supplierTable");
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
    function searchNameContact() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("firstname_contact_supplier");
      filter = input.value.toUpperCase();
      table = document.getElementById("supplierTable");
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
