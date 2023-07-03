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
  padding: 0.9rem 1.1rem;
  text-align: center;
  border-bottom: 1px solid #ddd;
}
th {
  font-weight: normal;
  font-size: .875rem;
  color: #666;
  background: #eee;
  /*  以下２行で見出しを固定  */
  position: sticky;
  top: 0;
}

img {
  width: 30px;
  display: block;
  margin: 0 auto;
  margin-bottom: .3rem;
}


h1 {
  text-align: center;
  font-size: 2.5rem;
  font-family: 'El Messiri', sans-serif;
}

    </style>
</head>

<body>
    <h1>La Liste Type de Depense</h1>
    <table>
      <thead>
        <tr class="heading">
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
          </tr>
      </thead>
     <tbody>
        @foreach ($expensetypes as $expensetype)
        <tr>
            <td>{{$expensetype->id}}</td>
            <td>{{$expensetype->name_expense_types}}</td>
            <td>{{$expensetype->description_expense_types}}</td>
        </tr>
        @endforeach
     </tbody>
    </table>
</body>

</html>
