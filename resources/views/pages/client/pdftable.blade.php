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
    <h1>La Liste Clients</h1>
    <table>
        <thead>
            <tr>
                <th>Nom Client</th>
                <th>Prenom Client</th>
                <th>Tel Client</th>
                <th>Email Client</th>
                <th>Adresse Client</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->firstname_customer }}</td>
                    <td>{{ $customer->lastname_customer }}</td>
                    <td>{{ $customer->tel_customer }}</td>
                    <td>{{ $customer->email_customer }}</td>
                    <td>{{ $customer->address_customer }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
