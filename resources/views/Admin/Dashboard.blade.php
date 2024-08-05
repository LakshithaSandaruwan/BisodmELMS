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
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawAllCharts);

        function drawAllCharts() {
            drawRegistrationChart();
            drawPopularSubjectsChart();
            drawTeacherRegistrationChart();
        }

        function drawRegistrationChart() {
            var currentMonthData = @json($currentMonthData);
            var lastMonthData = @json($lastMonthData);

            var daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
            var daysInLastMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 0).getDate();

            var chartData = [
                ['Day', 'Last Month', 'Current Month']
            ];
            for (var i = 1; i <= Math.max(daysInLastMonth, daysInMonth); i++) {
                chartData.push([
                    i.toString(),
                    lastMonthData[i] || 0,
                    currentMonthData[i] || 0
                ]);
            }

            var data = google.visualization.arrayToDataTable(chartData);

            var options = {
                title: 'Student Registration Comparison',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Day'
                },
                vAxis: {
                    title: 'Number of Registrations'
                },
                colors: ['#1b9e77', '#d95f02']
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
            chart.draw(data, options);
        }

        function drawPopularSubjectsChart() {
            var data = google.visualization.arrayToDataTable([
                ['Subject', 'Enrollments'],
                @foreach ($popularSubjects as $subject)
                    ['{{ $subject->subject_name }}', {{ $subject->enrollment_count }}],
                @endforeach
            ]);

            var options = {
                title: 'Most Popular Subjects',
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Number of Enrollments',
                    minValue: 0
                },
                vAxis: {
                    title: 'Subject'
                },
                colors: ['#1b9e77']
            };

            var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));
            chart.draw(data, options);
        }

        function drawTeacherRegistrationChart() {
            var currentMonthData = @json($currentMonthTeachersData);
            var lastMonthData = @json($lastMonthTeachersData);

            var daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
            var daysInLastMonth = new Date(new Date().getFullYear(), new Date().getMonth(), 0).getDate();

            var chartData = [
                ['Day', 'Last Month', 'Current Month']
            ];
            for (var i = 1; i <= Math.max(daysInLastMonth, daysInMonth); i++) {
                chartData.push([
                    i.toString(),
                    lastMonthData[i] || 0,
                    currentMonthData[i] || 0
                ]);
            }

            var data = google.visualization.arrayToDataTable(chartData);

            var options = {
                title: 'Teacher Registration Comparison',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Day'
                },
                vAxis: {
                    title: 'Number of Registrations'
                },
                colors: ['#1b9e77', '#d95f02']
            };

            var chart = new google.visualization.LineChart(document.getElementById('teacher_chart'));
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
            @include('Admin.Include.Sidebar')
        </div>

        <div class="content">
            @include('Admin.Include.Navbar')
            <form action="{{ route('admin.backup') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary">Create Backup</button>
            </form>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Students</p>
                                <h6 class="mb-0">{{ $students }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Teachers</p>
                                <h6 class="mb-0">{{ $teachers }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Month Revenue</p>
                                <h6 class="mb-0">LKR {{ $totalAmountforCorrentMonth }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">LKR {{ $totalAmount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Student Registration Comparison</h2>
                        <div id="curve_chart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Most Popular Subjects</h2>
                        <div id="bar_chart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Teacher Registration Comparison</h2>
                        <div id="teacher_chart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>

            @include('CDNs.AdminJS')
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </div>
</body>

</html>
