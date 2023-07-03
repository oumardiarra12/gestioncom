@extends('layouts.master')
@section('title', 'Gestion Produits')

@section('title_toolbar', 'La liste des Produits')
@section('subtitle_toolbar', 'Gestion des Produits')

@section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('produits.createproduct') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Produit
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
                            <a href="{{route('produits.pdftable')}}"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a  href="{{route('produits.exportproduit')}}"><img
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
                                <input type="text"  name="ref_product" id="ref_product" onkeyup="searchRefProduct()" placeholder="Entre Reference du Produit">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select" id="categorie" onchange="searchCategorie()">
                                    <option selected disabled hidden>----</option>
                                    @foreach ($categories as $categorie)
                                    <option value="{{$categorie->name_category}}">{{$categorie->name_category}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select" id="unite" onchange="searchUnite()">
                                    <option selected disabled hidden>----</option>
                                    @foreach ($unites as $unite)
                                    <option value="{{$unite->name_unit}}">{{$unite->name_unit}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew" id="productTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>Nom Produit</th>
                            <th>Ref</th>
                            <th>Categorie </th>
                            <th>Prix Vente</th>
                            <th>Prix Achat</th>
                            <th>Unite</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($produits as $produit)
                       <tr>
                        {{-- <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td> --}}
                        <td class="productimgname">
                            <a href="javascript:void(0);" class="product-img">
                                <img src="{{ asset('/storage/imageproduits/'.$produit->image_product) }}" alt="product">
                            </a>
                            <a href="javascript:void(0);">{{$produit->name_product}}</a>
                        </td>
                        <td>{{$produit->ref_product}}</td>
                        <td>{{$produit->category->name_category}}</td>
                        <td>{{$produit->price_sale}}</td>
                        <td>{{$produit->price_purchase}}</td>
                        <td>{{$produit->unit->name_unit}}</td>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('produits.show',  $produit->id) }}" class="dropdown-item"><img
                                            src="assets/img/icons/eye1.svg" class="me-2" alt="img" />Détail</a>
                                </li>
                                <li>
                                    <a href="{{ route('produits.edit',  $produit->id) }}" class="dropdown-item"><img
                                            src="assets/img/icons/edit.svg" class="me-2" alt="img" />Éditer</a>
                                </li>
                                <li>
                                    <form class="delete-item d-inline" method="post"
                                        action="{{ route('produits.delete',  $produit->id) }}">
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
    function searchRefProduct() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("ref_product");
      filter = input.value;
      table = document.getElementById("productTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.indexOf(filter) > -1) {
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
      table = document.getElementById("productTable");
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
    function searchUnite() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("unite");
      filter = input.value.toUpperCase();
      table = document.getElementById("productTable");
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

