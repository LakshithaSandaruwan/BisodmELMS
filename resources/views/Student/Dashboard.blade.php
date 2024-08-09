<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAllCharts);

        function drawAllCharts() {
            drawAcademicPerformanceChart();
            drawAttendanceRecordChart();
        }

        function drawAcademicPerformanceChart() {
            var data = google.visualization.arrayToDataTable([
                ['Subject', 'Score'],
                @foreach ($results as $result)
                    @if ($result->results !== 'pending')
                        ['{{ $result->subject_name }}', {{ $result->results ?? 0 }}],
                    @endif
                @endforeach
            ]);

            var options = {
                title: 'Academic Performance',
                hAxis: {
                    title: 'Subjects'
                },
                vAxis: {
                    title: 'Scores'
                },
                colors: ['#1b9e77']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('academic_performance_chart'));
            chart.draw(data, options);
        }

        function drawAttendanceRecordChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Attendance'],
                ['January', 90],
                ['February', 85],
                ['March', 88],
                ['April', 92],
                ['May', 95],
                ['June', 80],
                ['July', 87],
                ['August', 89],
                ['September', 93],
                ['October', 90],
                ['November', 91],
                ['December', 88]
            ]);

            var options = {
                title: 'Attendance Record',
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Attendance Rate (%)'
                },
                colors: ['#1b9e77']
            };

            var chart = new google.visualization.LineChart(document.getElementById('attendance_record_chart'));
            chart.draw(data, options);
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
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-book fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Subjects Enrolled</p>
                                <h6 class="mb-0">{{$enrollcount}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Academic Performance</h2>
                        <div id="academic_performance_chart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
