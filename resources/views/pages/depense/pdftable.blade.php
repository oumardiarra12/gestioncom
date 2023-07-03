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

        h1 {
            text-align: center;
            font-size: 2.5rem;
            font-family: 'El Messiri', sans-serif;
        }
    </style>
</head>

<body>
    <h1>La Liste de Depense</h1>
    <table>
        <thead>
            <tr>
                <th>Ref</th>
                <th>Motif</th>
                <th>Montant</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>
                        {{ $expense->number_expense }}
                    </td>
                    <td>{{ $expense->reason }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->typeexpense->name_expense_types }}</td>
                    <td>{{ $expense->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
