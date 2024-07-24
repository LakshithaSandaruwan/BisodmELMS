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
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="sidebar pe-4 pb-3">
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="overflow-hidden card table-nowrap table-card mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Quizzes</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Subject</th>
                                <th>Deadline</th>
                                <th>Quiz name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $quiz)
                                <tr class="align-middle">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="h6 mb-0 lh-1">{{ $quiz->subject_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{ $quiz->deadline }}</td>
                                    <td>
                                        {{$quiz->QuizName}}
                                    </td>
                                    <td>
                                        <a href="/view-quiz-questions/{{$quiz->id}}">Open the peper</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
