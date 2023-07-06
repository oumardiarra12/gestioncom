@extends('layouts.master')
@section('title', 'Gestion Home')

@section('title_toolbar', 'Home')
@section('subtitle_toolbar', 'Home')

@section('btn_add_item')
    <h2>Bienvenu {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-12">
            <div class="dash-widget">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash1.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$totalcomptoir}}">{{$totalcomptoir}}</span></h5>
                    <h6>Total Vente Comptoir Par Jour</h6>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash2.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{$totalreturncustomer}}">{{$totalreturncustomer}}</span></h5>
                    <h6>Total Retour Vente Par Jour</h6>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-sm-6 col-12">
        <div class="dash-widget dash2">
            <div class="dash-widgetimg">
                <span><img src="assets/img/icons/dash3.svg" alt="img"></span>
            </div>
            <div class="dash-widgetcontent">
                <h5><span class="counters" data-count="{{$totalpurchaseinvoice}}">{{$totalpurchaseinvoice}}</span></h5>
                <h6>Montant d'Achat</h6>
            </div>
        </div>
    </div> --}}
        {{-- <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3">
                <div class="dash-widgetimg">
                    <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="2500">2500</span></h5>
                    <h6>Depense par Jour et par Utilisateur</h6>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-6 col-sm-6 col-12 d-flex">
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
    </div>

    <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Ventes Comptoir</h5>
                </div>
                <div class="card-body">
                    <div id="s-line"></div>
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
@endsection
@section('script')
    <script>
        var sline = {
            chart: {
                height: 350,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "straight"
            },
            series: [{
                name: "Vente",
                data: {!! json_encode($datacomptoir) !!},
            }, ],
            title: {
                text: "Vente Comptoir Par Mois et Par Utilisateur",
                align: "left"
            },
            grid: {
                row: {
                    colors: ["#f1f2f3", "transparent"],
                    opacity: 0.5
                }
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                ],
            },
            yaxis: {
                show: true,
                min: 100,
                max: 1000000
            }
        };
        var chart = new ApexCharts(document.querySelector("#s-line"), sline);
        chart.render();
    </script>
@endsection
