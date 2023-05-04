@extends('layouts.master')
@section('title','Gestion Utilisateur')

@section('title_toolbar','La liste des  Utilisateurs')
@section('subtitle_toolbar','Gestion des Utilisateurs')

@section('btn_add_item')
<div class="page-btn">
    <a href="{{route('utilisateur.create')}}"  class="btn btn-added">
        <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
        Ajouter un Utilisateur
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
                        <img src="assets/img/icons/filter.svg" alt="img" />
                        <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                </div>
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img" /></a>
                </div>
            </div>
            <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                src="assets/img/icons/pdf.svg" alt="img" /></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                src="assets/img/icons/excel.svg" alt="img" /></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                src="assets/img/icons/printer.svg" alt="img" /></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" name="firstname" id="firstname" onkeyup="searchFirstname()" placeholder="Entre le Nom" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" id="telephone" onkeyup="searchTelephone()" placeholder="Entre le Telephone" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <select class="select" id="categorie" onchange="searchCategorie()">
                                <option selected disabled hidden>----</option>
                                @foreach ($categories as $categorie)
                                <option value="{{$categorie->name_category_users}}">{{$categorie->name_category_users}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg"
                                    alt="img" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew" id="userTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Numéro</th>
                        <th>Email</th>
                        <th>Categorie</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->CategoryUser->name_category_users }}</td>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('utilisateur.show',  $user->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/eye1.svg" class="me-2" alt="img" />Détail</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('utilisateur.edit',  $user->id) }}" class="dropdown-item"><img
                                                src="assets/img/icons/edit.svg" class="me-2" alt="img" />Éditer</a>
                                    </li>
                                    <li>
                                        <form class="delete-item d-inline" method="post"
                                            action="{{ route('utilisateur.delete',  $user->id) }}">
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
      input = document.getElementById("firstname");
      filter = input.value.toUpperCase();
      table = document.getElementById("userTable");
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
    function searchTelephone() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("telephone");
      filter = input.value.toUpperCase();
      table = document.getElementById("userTable");
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
    function searchCategorie() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("categorie");
      filter = input.value.toUpperCase();
      table = document.getElementById("userTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
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
@endsection
