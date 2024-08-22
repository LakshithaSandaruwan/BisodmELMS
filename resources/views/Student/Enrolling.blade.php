<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Enrollment</title>
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

            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Enrollment</h6>
                            <form action="saveenrolment" method="post">
                                @csrf
                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
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

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="batch" class="form-label">Select Year<span
                                                    class="text-danger">*</span></label>
                                            <select name="batch" id="batch" class="form-control" required>
                                                <option value="">Select batch</option>
                                                @foreach ($batches as $batche)
                                                    <option value="{{ $batche->id }}"> {{ $batche->Year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="gradename" class="form-label">Grade<span
                                                    class="text-danger">*</span></label>
                                            <select name="grade" id="grade" class="form-control" required>
                                                <option value="">Select grade</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">Grade {{ $grade->Grade }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="subject" class="form-label">Subject<span
                                                    class="text-danger">*</span></label>
                                            <select name="subject" id="subject" class="form-control" required>
                                                <option value="">Select Subject</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Enroll</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="overflow-hidden card table-nowrap table-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="mb-4">My Enrolments</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="small text-uppercase bg-body text-muted">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Zoom Link</th>
                                                <th>Day</th>
                                                <th>Time</th>
                                                <th>Next Payment</th>
                                                <th>Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enrolmentDetails as $enrolmentDetail)
                                                <tr class="align-middle">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <div class="h6 mb-0 lh-1">
                                                                    {{ $enrolmentDetail->subject_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($enrolmentDetail->days_remaining < -5)
                                                            <a class="disabled" href="#"><b><span
                                                                        class="badge bg-danger">Suspend</span></b></a>
                                                        @else
                                                            <a href="{{ $enrolmentDetail->zoom_link }}"><b>Click To
                                                                    Join</b></a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $enrolmentDetail->day }} </td>
                                                    <td>{{ $enrolmentDetail->stime }} - {{ $enrolmentDetail->etime }}
                                                    </td>
                                                    <td> {{ $enrolmentDetail->Next_Payment_Date }}</td>
                                                    <td>
                                                        @if ($enrolmentDetail->days_remaining < 0)
                                                            <p class="text-danger fw-bold">Overdue by
                                                                {{ abs($enrolmentDetail->days_remaining) }} days.<br>
                                                                Click <a href="/payment/{{$enrolmentDetail->id}}">Here</a> to payment</p>
                                                        @else
                                                            <p class="text-success fw-bold">
                                                                {{ $enrolmentDetail->days_remaining }} days remaining
                                                            </p>
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
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>



    @include('CDNs.AdminJS')

    <script>
        $(document).ready(function() {
            $('#grade').on('change', function() {
                var gradeId = $(this).val();
                var batchId = $('#batch').val();

                if (gradeId) {
                    $.ajax({
                        url: '/subjects-by-grade/' + gradeId + '/' + batchId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('#subject').empty();
                            $('#subject').append('<option value="">Select Subject</option>');
                            $.each(data, function(key, value) {
                                $('#subject').append('<option value="' + value.id +
                                    '">' + value.subject_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subject').empty();
                    $('#subject').append('<option value="">Select Subject</option>');
                }
            });
        });
    </script>
</body>

</html>
