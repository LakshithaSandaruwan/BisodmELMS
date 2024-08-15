<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Students payments {{$startDate}} to {{$endDate}}</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">Teacher name</th>
                <th scope="col">Month</th>
                <th scope="col">Basic</th>
                <th scope="col">Bonus</th>
                <th scope="col">Insitute deductions</th>
                <th scope="col">Taxes</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->full_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->month)->format('F') }}</td>
                    <td>{{ $payment->basic }}</td>
                    <td>{{ $payment->bonus }}</td>
                    <td>{{ $payment->insitute_pay }}</td>
                    <td>{{ $payment->taxes }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
