<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
  table {
  border-collapse: collapse;
  width: 100%;
}
th,
td {
  padding: 1rem 2rem;
  text-align: center;
  border-bottom: 1px solid #ddd;
}
th {
  font-weight: normal;
  font-size: 1.1rem;
  color: #666;
  background: #eee;
  /*  以下２行で見出しを固定  */
  position: sticky;
  top: 0;
}

h1 {
  text-align: center;
  font-size: 2.5rem;
  font-family: 'El Messiri', sans-serif;
}

    </style>
</head>

<body>
    <h1>La Liste Produits</h1>
    <table>
      <thead>
        <tr>
            <th>Ref</th>
            <th>Nom</th>
            <th>Code Barre</th>
            <th>Prix Vente</th>
            <th>Prix Achat</th>
            <th>Stock Actuel</th>
            <th>Stock Mini</th>
            <th>Categorie</th>
            <th>Unite</th>
          </tr>
      </thead>
     <tbody>
        @foreach ($produits as $produit)
        <tr>
            <td>{{$produit->ref_product}}</td>
            <td class="car-name">
              <span><img src="{{ public_path('imageproduits/'.$produit->image_product) }}" style="width:60px; height:60px;" alt="">
              {{$produit->name_product}}</span>
            </td>
            <td>{!! DNS1D::getBarcodeHTML($produit->codebarre_product, 'C39',1) !!}</td>
            <td>{{$produit->price_sale}}</td>
            <td>{{$produit->price_purchase}}</td>
            <td>{{$produit->stock_actuel}}</td>
            <td>{{$produit->stock_min}}</td>
            <td>{{$produit->category->name_category}}</td>
            <td>{{$produit->unit->name_unit}}</td>
        </tr>
        @endforeach
     </tbody>
    </table>
</body>

</html>
