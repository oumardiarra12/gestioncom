@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash1.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$purchaseinvoice_sum}}">{{$purchaseinvoice_sum}}</span></h5>
                    <h6>Total Achats Impayer</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash2.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$customerinvoice_sum}}">{{$customerinvoice_sum}}</span></h5>
                    <h6>Total Ventes Impayer</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash3.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$totalpurchaseinvoice}}">{{$totalpurchaseinvoice}}</span></h5>
                    <h6>Montant d'Achat</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$totalcustomerinvoice}}">{{$totalcustomerinvoice}}</span></h5>
                    <h6>Montant  de Vente</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{$customercount}}</h4>
                    <h5>Clients</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{$supplycount}}</h4>
                    <h5>Fournisseurs</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{$purchaseInvoicecount}}</h4>
                    <h5>Facture Achat</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="file-text"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{$customerInvoicecount}}</h4>
                    <h5>Facture Vente</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="file"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Achats & Ventes</h5>
                    {{-- <div class="graph-sets">
                        <ul>
                            <li>
                                <span>Ventes</span>
                            </li>
                            <li>
                                <span>Achats</span>
                            </li>
                        </ul>
                        <div class="dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                2022 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2020</a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div id="s-col"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        Produits récemment ajoutés</h4>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="{{route('produits.index')}}" class="dropdown-item">Liste Produit</a>
                            </li>
                            <li>
                                <a href="{{route('produits.createproduct')}}" class="dropdown-item">Nouveau Produit</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable ">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Produits</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td class="productimgname">
                                        <a href="{{route('produits.index')}}" class="product-img">
                                            <img src="{{ asset('/storage/imageproduits/'.$product->image_product) }}" alt="product">
                                        </a>
                                        <a href="{{route('produits.index')}}">{{$product->name_product}}</a>
                                    </td>
                                    <td>{{$product->price_sale}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">Expired Products</h4>
            <div class="table-responsive dataview">
                <table class="table datatable ">
                    <thead>
                        <tr>
                            <th>SNo</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Brand Name</th>
                            <th>Category Name</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><a href="javascript:void(0);">IT0001</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product2.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Orange</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>12-12-2022</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="javascript:void(0);">IT0002</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product3.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Pineapple</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>25-11-2022</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="javascript:void(0);">IT0003</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product4.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Stawberry</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>19-11-2022</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><a href="javascript:void(0);">IT0004</a></td>
                            <td class="productimgname">
                                <a class="product-img" href="productlist.html">
                                    <img src="assets/img/product/product5.jpg" alt="product">
                                </a>
                                <a href="productlist.html">Avocat</a>
                            </td>
                            <td>N/D</td>
                            <td>Fruits</td>
                            <td>20-11-2022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

@endsection
@section('script')
    <script type="text/javascript">
     var sCol = {
            chart: { height: 350, type: "bar", toolbar: { show: false } },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                },
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ["transparent"] },
            series: [
                {
                    name: "Achat",
                    data:{!! json_encode($datapurchase) !!},
                },
                {
                    name: "Vente",
                    data: {!! json_encode($datacustomer) !!},
                },
            ],
            xaxis: {
                categories: [
                    "Fev",
                    "Mar",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juiel",
                    "Aout",
                    "Sep",
                    "Oct",
                ],
            },
            yaxis: { title: { text: "FCFA (cent)" } },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "FCFA " + val + " cent";
                    },
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#s-col"), sCol);
        chart.render();
    </script>
@endsection



