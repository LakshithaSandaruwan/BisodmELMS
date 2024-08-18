<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="container">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="overflow-hidden card table-nowrap table-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-4">Classes</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="small text-uppercase bg-body text-muted">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Grade</th>
                                                <th>Teacher Name</th>
                                                <th>Access Link</th>
                                                <th>Day</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($timetables as $timetable)
                                                <tr class="align-middle">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div class="h6 mb-0 lh-1">
                                                                    {{ $timetable->subject_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$timetable->Grade}}</td>
                                                    <td>{{$timetable->full_name}}</td>
                                                    <td> <a href="{{ $timetable->zoom_link }}">JOIN</a></td>
                                                    <td>{{ $timetable->day }} </td>
                                                    <td>{{ $timetable->StartTime }} - {{ $timetable->EndTime }}
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
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
</body>

</html>
