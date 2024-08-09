<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>All Students</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            @include('Admin.Include.Sidebar')
        </div>

        <div class="content">
            @include('Admin.Include.Navbar')
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Teachers</h6>
                            <input type="text" id="search-studnts" class="form-control mb-4"
                                placeholder="Search by Teacher Name">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Birthday</th>
                                        <th scope="col">School</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Parent Contact</th>
                                    </tr>
                                </thead>
                                <tbody id="teacher-table-body">
                                    @foreach ($students as $student)
                                        <tr>
                                            <th scope="row">{{ $student->id }}</th>
                                            <td>{{ $student->FullName }} </td>
                                            <td>{{ $student->Gender }}</td>
                                            <td>{{ $student->birthday }}</td>
                                            <td>{{ $student->school }} </td>
                                            <td>{{ $student->houseNumber }}, {{ $student->street }},
                                                {{ $student->district }}</td>
                                            <td>{{ $student->contactNumber }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->PerentContact }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        $(document).ready(function() {
            $('#search-studnts').on('keyup', function() {
                var query = $(this).val();

                $.ajax({
                    url: "{{ route('filter.students') }}", // Your route to fetch filtered teachers
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        console.log(data);
                        $('#teacher-table-body').html(''); // Clear the existing table body
                        $.each(data, function(key, student) {
                            $('#teacher-table-body').append(
                                '<tr>' +
                                '<th scope="row">' + student.id + '</th>' +
                                '<td>' + student.FullName + '</td>' +
                                '<td>' + student.Gender + '</td>' +
                                '<td>' + student.birthday + '</td>' +
                                '<td>' + student.school + '</td>' +
                                '<td>' + student.houseNumber + ', ' + student
                                .street + ', ' + student.district + '</td>' +
                                '<td>' + student.contactNumber + '</td>' +
                                '<td>' + student.email + '</td>' +
                                '<td>' + student.PerentContact + '</td>' +
                                '</tr>'
                            );
                        });
                    }
                });
            });
        });
    </script>



    @include('CDNs.AdminJS')
</body>

</html>
