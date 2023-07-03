<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            /* width: 90%;
            margin: auto;
            overflow: hidden; */
            padding: 10px;
            /* margin-top: 10px; */
        }

        .container ul {
            padding: 0px;
            margin: 0px;
        }


        .container ul li {
            /* float: left; */
            margin: 2px;
            display:inline-block;
            list-style: none;
            width: 40%;
            height: 100px;
            border: 2px solid black;
            box-sizing: border-box;
        }

        .container ul li .bottom {
            /* width: 100%;
            height: 40px; */
            text-align: center;
            padding: 2px;
            color: black;
            font-size: 15px;

        }
        .code,h4,p,span,b{
            margin: 0px;
            padding: 0px;
        }
        .code{
            text-align: center;
        }


    </style>
</head>

<body>
    <div class="container">
        <ul>
            @foreach ($produits as $produit)
                <li>
                    <div class="bottom">
                        <span class="code">{!! DNS1D::getBarcodeHTML($produit->codebarre_product, 'C39',1) !!}</span>
                            <span><b>{{ $produit->codebarre_product }}</b></span><br />
                            <p><span><b>Nom: {{ $produit->name_product }}</b></span><br />
                                <span><b>vente: {{ $produit->price_sale }}</b></span>
                            </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
