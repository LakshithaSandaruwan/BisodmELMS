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
                <th scope="col">Student name</th>
                <th scope="col">Grade</th>
                <th scope="col">Subject</th>
                <th scope="col">Payment date</th>
                <th scope="col">Next payment date</th>
                <th scope="col">Fees</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->FullName }}</td>
                    <td>{{ $payment->Grade }}</td>
                    <td>{{ $payment->subject_name }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->Next_Payment_Date }}</td>
                    <td>{{ $payment->amount }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
