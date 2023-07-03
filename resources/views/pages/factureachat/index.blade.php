@extends('layouts.master')
@section('title', 'Gestion Facture Achat')

@section('title_toolbar', 'La liste des Facture Achats')
@section('subtitle_toolbar', 'Gestion des Facture Achats')

{{-- @section('btn_add_item')
    <div class="page-btn">
        <a href="{{ route('achatfactures.create') }}" class="btn btn-added">
            <img src="assets/img/icons/plus.svg" alt="img"class="me-1">
            Ajouter un Facture Achat
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
                            <a href="{{ route('achatfactures.pdftable') }}"><img src="assets/img/icons/pdf.svg"
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
                                <input type="text" name="num_purchase_invoice" placeholder="Entre le Numero de Facture"
                                    id="num_purchase_invoice" onkeyup="searchNumFacture()">
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-6 col-12">
                            <div class="form-group">
                                <select class="select" id="status_purchase_invoice" onchange="searchStatusfacture()">
                                    <option selected disabled hidden>----</option>
                                    <option value="no_pay">Non Payer</option>
                                    <option value="pay">Payer</option>
                                    <option value="partial_pay">Payer Partial</option>
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
                <table class="table datanew" id="factureTable">
                    <thead>
                        <tr>
                            {{-- <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th> --}}
                            <th>No Facture</th>
                            <th>Status</th>
                            <th>Reception</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseinvoices as $purchaseinvoice)
                            <tr>
                                {{-- <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" value="{{ $purchaseinvoice->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td> --}}
                                <td>{{ $purchaseinvoice->num_purchase_invoice }}</td>
                                <td @if($purchaseinvoice->status_purchase_invoice =='no_pay')  style="color: red;" @elseif ($purchaseinvoice->status_purchase_invoice=="partial_pay") style="color: yellow;" @else style="color: green;" @endif>{{ $purchaseinvoice->status_purchase_invoice }}</td>
                                <td>{{ $purchaseinvoice->reception->num_reception }}</td>
                                <td>{{$purchaseinvoice->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown"
                                        aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('achatfactures.show', $purchaseinvoice->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/eye1.svg" class="me-2"
                                                    alt="img" />Détail</a>
                                        </li>
                                        @if($purchaseinvoice->status_purchase_invoice =='no_pay')
                                        <li>
                                            <a href="{{ route('achatfactures.edit', $purchaseinvoice->id) }}"
                                                class="dropdown-item"><img src="assets/img/icons/edit.svg"
                                                    class="me-2" alt="img" />Éditer</a>
                                        </li>
                                        <li>
                                            <form class="delete-item d-inline" method="post"
                                                action="{{ route('achatfactures.delete', $purchaseinvoice->id) }}">
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
                                        @if($purchaseinvoice->status_purchase_invoice =='no_pay' || $purchaseinvoice->status_purchase_invoice =='partial_pay' )
                                        <li>
                                            <a href="{{route('supplierpayements.create',$purchaseinvoice->id)}}" class="dropdown-item"><img src="assets/img/icons/plus-circle.svg" class="me-2" alt="img">Create Paiment</a>
                                            </li>
                                        @endif
                                        @if($purchaseinvoice->status_purchase_invoice =='pay' || $purchaseinvoice->status_purchase_invoice =='partial_pay' )
                                            <li>
                                                <a href="{{route('supplierpayements.showpayment',$purchaseinvoice->id)}}" class="dropdown-item" ><img src="assets/img/icons/dollar-square.svg" class="me-2" alt="img">Show Paiments</a>
                                                </li>
                                        @endif




                                    </ul>
                                </td>
                            </tr>
                            {{-- <div class="modal fade" id="showpayment" tabindex="-1" aria-labelledby="showpayment" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Show Payments</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Reference</th>
                                                            <th>Amount </th>
                                                            <th>Paid By </th>
                                                            <th>Paid By </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="bor-b1">
                                                            <td>2022-03-07 </td>
                                                            <td>INV/SL0101</td>
                                                            <td>$ 0.00 </td>
                                                            <td>Cash</td>
                                                            <td>
                                                                <a class="me-2" href="javascript:void(0);">
                                                                    <img src="assets/img/icons/printer.svg" alt="img">
                                                                </a>
                                                                <a class="me-2" href="javascript:void(0);" data-bs-target="#editpayment"
                                                                    data-bs-toggle="modal" data-bs-dismiss="modal">
                                                                    <img src="assets/img/icons/edit.svg" alt="img">
                                                                </a>
                                                                <a class="me-2 confirm-text" href="javascript:void(0);">
                                                                    <img src="assets/img/icons/delete.svg" alt="img">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="modal fade" id="createpayment" tabindex="-1" aria-labelledby="createpayment" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <form  method="POST" action="{{ route('supplierpayements.store', $purchaseinvoice->id) }}">
                                            @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create Payement Fournisseur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">

                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label>Reference Facture</label>
                                                            <input type="text" value="{{$purchaseinvoice->num_purchase_invoice}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label>Montant A Payer</label>
                                                            <input type="text" name="amount_to_be_paid" value="{{$purchaseinvoice->total_purchase_invoice}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label> Montant Payer</label>
                                                            <input type="text" name="amount_to_pay" >
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label>Reste a Payer</label>
                                                            <input type="text" name="reste" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group mb-0">
                                                            <label>Note</label>
                                                            <textarea class="form-control" name="description_supplier_payment"></textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-submit">Submit</button>
                                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div> --}}


                            <div class="modal fade" id="editpayment" tabindex="-1" aria-labelledby="editpayment" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Payment</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Customer</label>
                                                        <div class="input-groupicon">
                                                            <input type="text" value="2022-03-07" class="datetimepicker">
                                                            <div class="addonset">
                                                                <img src="assets/img/icons/datepicker.svg" alt="img">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Reference</label>
                                                        <input type="text" value="INV/SL0101">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Received Amount</label>
                                                        <input type="text" value="0.00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Paying Amount</label>
                                                        <input type="text" value="0.00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Payment type</label>
                                                        <select class="select">
                                                            <option>Cash</option>
                                                            <option>Online</option>
                                                            <option>Inprogress</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-0">
                                                        <label>Note</label>
                                                        <textarea class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-submit">Submit</button>
                                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        function searchNumFacture() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("num_purchase_invoice");
            filter = input.value.toUpperCase();
            table = document.getElementById("factureTable");
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

        function searchStatusfacture() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("status_purchase_invoice");
            filter = input.value.toUpperCase();
            table = document.getElementById("factureTable");
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
