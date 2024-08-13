<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Student Enrollments Chart
            var enrollmentData = google.visualization.arrayToDataTable([
                ['Subject', 'Number of Students'],
                @foreach ($enrollments as $enrollment)
                    ['{{ $enrollment[0] }}', {{ $enrollment[1] }}],
                @endforeach
            ]);

            var enrollmentOptions = {
                title: 'Student Enrollments by Subject',
                hAxis: {
                    title: 'Subject'
                },
                vAxis: {
                    title: 'Number of Students'
                },
                legend: 'none'
            };

            var enrollmentChart = new google.visualization.ColumnChart(document.getElementById('enrollment_chart_div'));
            enrollmentChart.draw(enrollmentData, enrollmentOptions);

            // Teacher Payments Chart
            var paymentData = google.visualization.arrayToDataTable([
                ['Month', 'Basic Salary'],
                @foreach ($paymentsData as $payment)
                    ['{{ $payment['month'] }}', {{ $payment['total_basic'] }}],
                @endforeach
            ]);

            var paymentOptions = {
                title: 'Teacher Basic Salary by Month',
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Basic Salary'
                },
                legend: 'none'
            };

            var paymentChart = new google.visualization.ColumnChart(document.getElementById('payment_chart_div'));
            paymentChart.draw(paymentData, paymentOptions);
        }
    </script>
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
            @include('Teacher.Include.Sidebar')
        </div>

        <div class="content">
            @include('Teacher.Include.Navbar')

            <!-- Student Enrollments Chart -->
            <div id="enrollment_chart_div" style="width: 900px; height: 500px;"></div>

            <!-- Teacher Payments Chart -->
            <div id="payment_chart_div" style="width: 900px; height: 500px; margin-top: 20px;"></div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
