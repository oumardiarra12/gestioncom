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
  font-size: 1.2rem;
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
    <h1>La Liste Fournisseurs</h1>
    <table>
        <thead>
            <tr>
                <th>Nom Societe</th>
                <th>Tel Societe</th>
                {{-- <th>Email Societe</th> --}}
                <th>Nom de Contact</th>
                <th>Tel de Contact</th>
                <th>Email de Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name_supplier }}</td>
                    <td>{{ $supplier->tel_supplier }}</td>
                    {{-- <td>{{$supplier->email_supplier}}</td> --}}
                    <td>{{ $supplier->firstname_contact_supplier }}-{{ $supplier->lastname_contact_supplier }}</td>
                    <td>{{ $supplier->tel_contact_supplier }}</td>
                    <td>{{ $supplier->email_contact_supplier }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
