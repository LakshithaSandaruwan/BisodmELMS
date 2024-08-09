<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students PDF</title>
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
    <h1>Student List</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Birthday</th>
                <th scope="col">NIC</th>
                <th scope="col">Address</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    <th scope="row">{{ $teacher->id }}</th>
                    <td>{{ $teacher->full_name }}</td>
                    <td>{{ $teacher->gender }}</td>
                    <td>{{ $teacher->birthdate }}</td>
                    <td>{{ $teacher->nic }}</td>
                    <td>{{ $teacher->houseNumber }}, {{ $teacher->street }}, {{ $teacher->district }}</td>
                    <td>{{ $teacher->contact }}</td>
                    <td>{{ $teacher->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
