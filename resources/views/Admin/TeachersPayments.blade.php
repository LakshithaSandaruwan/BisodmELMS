<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Teacher Payments</title>
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
                            <h6 class="mb-4">Teachers Payments</h6>

                            <form action="/PrintTeacherPayments" method="POST">
                                @csrf
                                <div class="row mb-4">

                                    <div class="col-md-4">
                                        <label for="startdate">From date</label>
                                        <input type="date" name="startdate" id="startdate" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="enddate">To date</label>
                                        <input type="date" name="enddate" id="enddate" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label for=""></label>
                                        <button id="submitButton" type="submit" class="btn btn-success mt-4"
                                            disabled>PRINT</button>
                                    </div>

                                </div>
                            </form>

                            <table class="table">
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
                                <tbody id="teacher-table-body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#enddate').change(function() {
                var startDate = $('#startdate').val();
                var endDate = $(this).val();

                if (startDate && endDate) {
                    $('#submitButton').prop('disabled', false); // Enable the submit button
                } else {
                    $('#submitButton').prop('disabled',
                        true); // Disable the submit button if conditions are not met
                }

                if (startDate && endDate) {
                    $.ajax({
                        url: "{{ route('get.teacherspayments') }}",
                        type: "GET",
                        data: {
                            startdate: startDate,
                            enddate: endDate
                        },
                        success: function(data) {

                            var tbody = $('#teacher-table-body');
                            tbody.empty();

                            $.each(data, function(index, payment) {
                                var row = `<tr>
                                <td>${payment.full_name}</td>
                                <td>${payment.month}</td>
                                <td>${payment.basic}</td>
                                <td>${payment.bonus}</td>
                                <td>${payment.insitute_pay}</td>
                                <td>${payment.taxes}</td>
                            </tr>`;
                                tbody.append(row);
                            });
                        }
                    });
                }
            });
        });
    </script>

    @include('CDNs.AdminJS')
</body>

</html>
