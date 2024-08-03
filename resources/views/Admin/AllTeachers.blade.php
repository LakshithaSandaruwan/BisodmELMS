<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>All Teachers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">NIC</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <th scope="row">{{ $teacher->id }}</th>
                                            <td>{{ $teacher->full_name }} </td>
                                            <td>{{ $teacher->nic }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->houseNumber }}, {{ $teacher->street }},
                                                {{ $teacher->district }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Salary</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">NIC</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <th scope="row">{{ $teacher->id }}</th>
                                            <td>{{ $teacher->full_name }} </td>
                                            <td>{{ $teacher->nic }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>
                                                @if ($teacher->total_students > 0)
                                                    @if ($teacher->has_payments)
                                                        <span class="badge bg-success">Paid</span>
                                                    @else
                                                        <a href="/teacherStudent/{{$teacher->id}}"><span class="badge bg-danger">Yet to pay</span></a>
                                                    @endif
                                                @else
                                                    <span class="badge bg-warning">N/A</span>
                                                @endif
                                            </td>
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

    @include('CDNs.AdminJS')
</body>

</html>
