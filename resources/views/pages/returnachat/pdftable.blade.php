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
  font-size: 1.4rem;
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
    <h1>La Liste Achats Retour</h1>
    <table>
        <thead>
            <tr>
                <th>No Retour Achat</th>
                <th>Total</th>
                <th>Fournisseur</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returnpurchases as $returnpurchase)
                <tr>
                    <td>{{ $returnpurchase->num_return_purchase }}</td>
                    <td>{{ $returnpurchase->total_return_purchase }}</td>
                    <td>{{ $returnpurchase->supplier->name_supplier }}</td>
                    <td>{{ $returnpurchase->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
