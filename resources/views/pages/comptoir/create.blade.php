@extends('layouts.masterpos')
@section('title', 'Gestion POS')

@section('title_toolbar', 'POS')
@section('subtitle_toolbar', 'Gestion des Vente')
@section('content')
    <div class="page-wrapper ms-0">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 col-sm-12 tabs_wrapper">
                    <div class="page-header ">
                        <div class="page-title">
                            <h4>Categories</h4>
                            <h6>Gestion de Vente</h6>
                        </div>
                    </div>
                    <ul class="tabs owl-carousel owl-theme owl-product  border-0 ">
                        @foreach ($categories as $categorie)
                            <li id="{{ $categorie->id }}">
                                <div class="product-details">
                                    <h6>{{ $categorie->name_category }}</h6>
                                </div>
                            </li>
                        @endforeach
                        {{-- <li class="active" id="fruits">
                        <div class="product-details ">
                            <img src="assets/img/product/product62.png" alt="img">
                            <h6>Fruits</h6>
                        </div>
                    </li>
                    <li id="headphone">
                        <div class="product-details ">
                            <img src="assets/img/product/product63.png" alt="img">
                            <h6>Headphones</h6>
                        </div>
                    </li>
                    <li id="Accessories">
                        <div class="product-details">
                            <img src="assets/img/product/product64.png" alt="img">
                            <h6>Accessories</h6>
                        </div>
                    </li>
                    <li id="Shoes">
                        <a class="product-details">
                            <img src="assets/img/product/product65.png" alt="img">
                            <h6>Shoes</h6>
                        </a>
                    </li>
                    <li id="computer">
                        <a class="product-details">
                            <img src="assets/img/product/product66.png" alt="img">
                            <h6>Computer</h6>
                        </a>
                    </li>
                    <li id="Snacks">
                        <a class="product-details">
                            <img src="assets/img/product/product67.png" alt="img">
                            <h6>Snacks</h6>
                        </a>
                    </li>
                    <li id="watch">
                        <a class="product-details">
                            <img src="assets/img/product/product68.png" alt="img">
                            <h6>Watches</h6>
                        </a>
                    </li>
                    <li id="cycle">
                        <a class="product-details">
                            <img src="assets/img/product/product61.png" alt="img">
                            <h6>Cycles</h6>
                        </a>
                    </li>
                    <li id="fruits1">
                        <div class="product-details ">
                            <img src="assets/img/product/product62.png" alt="img">
                            <h6>Fruits</h6>
                        </div>
                    </li>
                    <li id="headphone1">
                        <div class="product-details ">
                            <img src="assets/img/product/product63.png" alt="img">
                            <h6>Headphones</h6>
                        </div>
                    </li> --}}
                    </ul>
                    <div class="tabs_container">
                        @foreach ($categories as $category)
                            <div class="tab_content" data-tab="{{ $category->id }}">
                                <div class="row">
                                    @foreach ($category->products as $product)
                                        <a class="col-lg-3 col-sm-6 d-flex text-decoration-none addcart">
                                            <div
                                                class="{{ $product->category_id ? 'productset flex-fill' : 'productset flex-fill active' }}">
                                                <div class="productsetimg">
                                                    <img class="product_image"
                                                        src="{{ asset('/storage/imageproduits/' . $product->image_product) }}"
                                                        alt="img">
                                                    <input type="hidden" value="{{ $product->id }}" class="products_id" />
                                                    <h6 class="stock">Stock: {{ $product->stock_actuel }}</h6>
                                                    <div class="check-product">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="productsetcontent">
                                                    <h5>{{ $product->category->name_category }}</h5>
                                                    <h4 class="product_name">{{ $product->name_product }}</h4>
                                                    <h6 class="product_price">{{ $product->price_sale }}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach




                    </div>

                </div>
                <div class="col-lg-4 col-sm-12 ">
                    <div class="order-list">
                        {{-- <div class="orderid">
                            <h4>Order List</h4>
                            <h5>Transaction id : #65565</h5>
                        </div> --}}
                        <div class="actionproducts">
                            {{-- <ul>
                                <li>
                                    <a href="javascript:void(0);" class="deletebg confirm-text"><img
                                            src="assets/img/icons/delete-2.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                        class="dropset">
                                        <img src="assets/img/icons/ellipise1.svg" alt="img">
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                        data-popper-placement="bottom-end">
                                        <li>
                                            <a href="#" class="dropdown-item">Action</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item">Another Action</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item">Something Elses</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                    <div class="card card-order">
                        <form method="POST" action="{{ route('comptoirs.store') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal"
                                            data-bs-target="#create"><i class="fa fa-plus me-2"></i>Nouveau Client</a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="select-split ">
                                            <div class="select-group w-100">
                                                <select class="js-example-basic-single select2" name="customers_id">
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">
                                                            {{ $customer->firstname_customer }}
                                                            {{ $customer->lastname_customer }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12">
                                    <div class="select-split">
                                        <div class="select-group w-100">
                                            <select class="select">
                                                <option>Product </option>
                                                <option>Barcode</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                    {{-- <div class="col-12">
                                    <div class="text-end">
                                        <a class="btn btn-scanner-set"><img src="assets/img/icons/scanner1.svg"
                                                alt="img" class="me-2">Scan bardcode</a>
                                    </div>
                                </div> --}}
                                </div>
                            </div>
                            <div class="split-card">
                            </div>

                            <div class="card-body pt-0">
                                {{-- <div class="totalitem">
                                <h4>Total items : 4</h4>
                                <a href="javascript:void(0);">Clear all</a>
                            </div> --}}
                                <table class="table table-borderless" id="tablecard">

                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex p-0">
                                                <div>
                                                    <img src="{{ asset('/storage/imageproduits/' . $details['image']) }}"
                                                        alt="img">
                                                </div>
                                                <div>
                                                    <input type="text" class="border border-white" id="products_id"
                                                        name="products_id[]" readonly="readonly" />
                                                    <input type="hidden" name="products_id[]" class="products_id" />
                                                    <input type="hidden" name="price_linecomptoir[]"
                                                        class="price_linecomptoir" />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group"><input name="qty_linecomptoir[]"
                                                    class="form-control qty_linecomptoir update-cart" required="" />
                                            </div>
                                        </td>
                                        <td class="w-25"><input name="subtotal_linecomptoir[]"
                                                class="form-control border border-white subtotal_linecomptoir"></td>
                                        <td><a class="confirm-text remove-from-cart" href="javascript:void(0);"><img
                                                    src="assets/img/icons/delete-2.svg" alt="img"></a></td>
                                    </tr> --}}
                                </table>
                            </div>
                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0 pb-2">
                                <div class="setvalue">
                                    <ul>
                                        {{-- <li>
                                        <h5>Subtotal </h5>
                                        <h6>55.00$</h6>
                                    </li>
                                    <li>
                                        <h5>Tax </h5>
                                        <h6>5.00$</h6>
                                    </li> --}}
                                        <li class="total-value">
                                            <h5>Total </h5>
                                            <h6><input type="number" name="total_comptoir"
                                                    class="form-control border-0 text-primary total_comptoir" /></h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-submit btn-primary">Valider</button>
                                    <a class="btn  btn-danger videtable">Vide</a>
                                </div>
                        </form>
                        {{-- <div class="setvaluecash">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0);" class="paymentmethod">
                                            <img src="assets/img/icons/cash.svg" alt="img" class="me-2">
                                            Cash
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="paymentmethod">
                                            <img src="assets/img/icons/debitcard.svg" alt="img" class="me-2">
                                            Debit
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="paymentmethod">
                                            <img src="assets/img/icons/scan.svg" alt="img" class="me-2">
                                            Scan
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-totallabel">
                                <h5>Checkout</h5>
                                <h6>60.00$</h6>
                            </div> --}}
                        <div class="btn-pos">
                            <ul>
                                {{-- <li>
                                        <a class="btn"><img src="assets/img/icons/pause1.svg" alt="img"
                                                class="me-1">Hold</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="assets/img/icons/edit-6.svg" alt="img"
                                                class="me-1">Quotation</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="assets/img/icons/trash12.svg" alt="img"
                                                class="me-1">Void</a>
                                    </li>
                                    <li>
                                        <a class="btn"><img src="assets/img/icons/wallet1.svg" alt="img"
                                                class="me-1">Payment</a>
                                    </li> --}}
                                <li>
                                    <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img
                                            src="assets/img/icons/transcation.svg" alt="img" class="me-1">
                                        Transaction</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- <div class="modal fade" id="calculator" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Define Quantity</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="calculator-set">
                        <div class="calculatortotal">
                            <h4>0</h4>
                        </div>
                        <ul>
                            <li>
                                <a href="javascript:void(0);">1</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">2</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">3</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">4</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">5</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">6</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">7</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">8</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">9</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-closes"><img
                                        src="assets/img/icons/close-circle.svg" alt="img"></a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">0</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn btn-reverse"><img
                                        src="assets/img/icons/reverse.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="modal fade" id="holdsales" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hold order</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="hold-order">
                        <h2>4500.00</h2>
                    </div>
                    <div class="form-group">
                        <label>Order Reference</label>
                        <input type="text">
                    </div>
                    <div class="para-set">
                        <p>The current order will be set on hold. You can retreive this order from the pending order
                            button. Providing a reference to it might help you to identify the order more quickly.</p>
                    </div>
                    <div class="col-lg-12">
                        <a class="btn btn-submit me-2">Submit</a>
                        <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Order</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="text" value="20">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Product Price</label>
                                <select class="select">
                                    <option>Exclusive</option>
                                    <option>Inclusive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label> Tax</label>
                                <div class="input-group">
                                    <input type="text">
                                    <a class="scanner-set input-group-text">
                                        %
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Discount Type</label>
                                <select class="select">
                                    <option>Fixed</option>
                                    <option>Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text" value="20">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Sales Unit</label>
                                <select class="select">
                                    <option>Kilogram</option>
                                    <option>Grams</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a class="btn btn-submit me-2">Submit</a>
                        <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('clients.store') }}">
                        @csrf
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
                                <label>Nom Client</label>
                                <input type="text" name="firstname_customer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Prenom Client</label>
                                <input type="text" name="lastname_customer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Email Client</label>
                                <input type="email" name="email_customer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Tel Client</label>
                                <input type="text" name="tel_customer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Addresse Client</label>
                                <input type="text" name="address_customer">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description_customer"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2">Submit</button>
                        <a class="btn btn-cancel" data-bs-dismiss="modal">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Deletion</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="delete-order">
                        <img src="assets/img/icons/close-circle1.svg" alt="img">
                    </div>
                    <div class="para-set text-center">
                        <p>The current order will be deleted as no payment has been <br> made so far.</p>
                    </div>
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-danger me-2">Yes</a>
                        <a class="btn btn-cancel" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="recents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recent Transactions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabs-sets">
                        {{-- <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                    data-bs-target="#purchase" type="button" aria-controls="purchase"
                                    aria-selected="true" role="tab">Purchase</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
                                    type="button" aria-controls="payment" aria-selected="false"
                                    role="tab">Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return"
                                    type="button" aria-controls="return" aria-selected="false"
                                    role="tab">Return</button>
                            </li>
                        </ul> --}}
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                                aria-labelledby="purchase-tab">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                    <div class="wordset">
                                        <ul>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf" href="{{route('comptoirs.pdftable')}}"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Client</th>
                                                <th>Total </th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($comptoirs as $comptoir)
                                            <tr>
                                                <td>{{$comptoir->created_at->format('d-m-Y') }} </td>
                                                <td>{{$comptoir->num_comptoir}}</td>
                                                <td>{{$comptoir->customer->firstname_customer}} {{$comptoir->customer->lastname_customer}}</td>
                                                <td>{{$comptoir->total_comptoir}}</td>
                                                <td>
                                                    <a class="me-3" href="{{ route('comptoirs.show', $comptoir->id) }}">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    {{-- <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a> --}}
                                                    <a class="me-3 confirm-text"  href="{{ route('comptoirs.delete', $comptoir->id) }}">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="payment" role="tabpanel">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                    <div class="wordset">
                                        <ul>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                                        src="assets/img/icons/excel.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                        src="assets/img/icons/printer.svg" alt="img"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0101</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0102</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0103</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0104</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0105</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0106</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0107</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="return" role="tabpanel">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                    <div class="wordset">
                                        <ul>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                                        src="assets/img/icons/excel.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                                        src="assets/img/icons/printer.svg" alt="img"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0101</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0102</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0103</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0104</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0105</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0106</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2022-03-07 </td>
                                                <td>0107</td>
                                                <td>Walk-in Customer</td>
                                                <td>$ 1500.00</td>
                                                <td>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/eye.svg" alt="img">
                                                    </a>
                                                    <a class="me-3" href="javascript:void(0);">
                                                        <img src="assets/img/icons/edit.svg" alt="img">
                                                    </a>
                                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                                        <img src="assets/img/icons/delete.svg" alt="img">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function totalVente() {
                var totalVente = 0;
                $('.subtotal_linecomptoir').each(function(i, e) {
                    var soustotal = $(this).val() - 0;
                    totalVente += soustotal;
                })
                $('.total_comptoir').val(totalVente);
            }

            function updateitem(row) {
                //$(this).closest('tr')
                var qty = row.find('.qty_linecomptoir').val() - 0;
                var prixvente = row.find('.price_linecomptoir').val() - 0;
                var soustotal = qty * prixvente;
                row.find('.subtotal_linecomptoir').val(soustotal);
                totalVente();
            }
            $('#tablecard').delegate('.qty_linecomptoir', 'change', function() {
                updateitem($(this).closest('tr'))
            });
            $('#tablecard').delegate('.remove', 'click', function() {
                var l = $('#tablecard tr').length;
                if (l == 1) {
                    alert('Vous etes sur de Supprimer')
                } else {
                    $(this).parent().parent().remove();
                    totalVente()
                }
            });
            $(".addcart").on("click", function() {
                var product_name = $(this).find('.product_name').text();
                var product_price = $(this).find('.product_price').text();
                var product_image = $(this).find('.product_image').get(0).src;
                var products_id = $(this).find('.products_id').val();

                $('#tablecard').append(` <tr>
                                        <td>
                                            <div class="d-flex p-0">
                                                <div>
                                                    <img src="` + product_image + `"
                                                        alt="img">
                                                </div>
                                                <div>
                                                    <input type="text" class="border border-white" id="products_id"
                                                        value="` + product_name + `" readonly="readonly" />
                                                    <input type="hidden" name="products_id[]" value="` + products_id + `" class="products_id" />
                                                    <input type="hidden" name="price_linecomptoir[]"
                                                        class="price_linecomptoir" value="` + product_price +
                    `" />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group"><input  name="qty_linecomptoir[]"
                                                    class="form-control qty_linecomptoir update-cart" value="1" required="" />
                                            </div>
                                        </td>
                                        <td class="w-25"><input name="subtotal_linecomptoir[]"
                                                class="form-control border border-white subtotal_linecomptoir" value="` + product_price * 1 + `"></td>
                                        <td><a class="confirm-text remove" href="javascript:void(0);"><img
                                                    src="assets/img/icons/delete-2.svg" alt="img"></a></td>
                                    </tr>`);
                totalVente()
            });
            $('.videtable').on("click", function() {
                $('#tablecard').empty();
                totalVente()
                window.location.reload(true);
            })
        });
    </script>
@endsection
