<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .avatar.sm {
            width: 2.25rem;
            height: 2.25rem;
            font-size: .818125rem;
        }

        .table-nowrap .table td,
        .table-nowrap .table th {
            white-space: nowrap;
        }

        .table>:not(caption)>*>* {
            padding: 0.75rem 1.25rem;
            border-bottom-width: 1px;
        }

        table th {
            font-weight: 600;
            background-color: #eeecfd !important;
        }
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
       
        <div class="sidebar pe-4 pb-3">
            @include('Teacher.Include.Sidebar')
        </div>

        <div class="content">
            @include('Teacher.Include.Navbar')

            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-12 mb-3 mb-lg-5">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="overflow-hidden card table-nowrap table-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Results</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0" >
                                    <thead class="small text-uppercase bg-body text-muted">
                                        <tr>
                                            <th>Student name</th>
                                            <th>Correct answers</th>
                                            <th>Percentage (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $result)
                                            <tr class="align-middle">
                                               <td>{{$result->FullName}}</td>
                                               <td>{{$result->total_Correct_answers}}</td>
                                               <td class="text-danger fw-bold">{{ number_format(($result->total_Correct_answers / $result->total_answers) * 100, 2) }}%</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="overflow-hidden card table-nowrap table-card mt-5">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-danger">Yet to submit</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0" >
                                    <thead class="small text-uppercase bg-body text-muted">
                                        <tr>
                                            <th>Student name</th>
                                            <th>Student Email</th>
                                            <th>Perent Email</th>
                                            <th>Notify</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($NotSubmittedStudents as $NotSubmittedStudent)
                                            <tr class="align-middle">
                                               <td>{{$NotSubmittedStudent->FullName}}</td></td>
                                               <td>{{$NotSubmittedStudent->email}}</td>
                                               <td>{{$NotSubmittedStudent->PerentEmail}}</td>
                                               <td><a href="/notify-email/{{$id}}/{{$NotSubmittedStudent->id}}"><i class="fa fa-paper-plane" aria-hidden="true"></i></a></td>
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


    @include('CDNs.AdminJS')
</body>

</html>
