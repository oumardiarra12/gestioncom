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
    <h1>La Liste Receptions</h1>
    <table>
        <thead>
            <tr>
                <th>No Reception</th>
                <th>Status</th>
                <th>Commande Achat</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receptions as $reception)
                <tr>
                    <td>{{ $reception->num_reception }}</td>
                    <td>{{ $reception->status_reception }}</td>
                    <td>{{ $reception->purchase_order->num_purchase_order ?? 'pas de commande' }}</td>
                    <td>{{$reception->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
