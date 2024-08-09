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
        table, th, td {
            border: 1px solid black;
        }
        th, td {
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
                <th scope="col">School</th>
                <th scope="col">Address</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
                <th scope="col">Parent Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->FullName }}</td>
                    <td>{{ $student->Gender }}</td>
                    <td>{{ $student->birthday }}</td>
                    <td>{{ $student->school }}</td>
                    <td>{{ $student->houseNumber }}, {{ $student->street }}, {{ $student->district }}</td>
                    <td>{{ $student->contactNumber }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->PerentContact }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
