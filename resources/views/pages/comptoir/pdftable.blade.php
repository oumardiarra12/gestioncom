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
    <h1>La Liste Vente Comptoirs</h1>
    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Total</th>
                <th>Client</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comptoirs as $comptoir)
                <tr>
                    <td>{{ $comptoir->num_comptoir }}</td>
                    <td>{{ $comptoir->total_comptoir }}</td>
                    <td>{{ $comptoir->customer->firstname_customer }} {{ $comptoir->customer->lastname_customer }}</td>
                    <td>{{ $comptoir->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
