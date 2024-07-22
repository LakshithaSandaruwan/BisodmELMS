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
            var data = google.visualization.arrayToDataTable([
                ['Month', '2023', '2024'],
                ['January', 100, 120],
                ['February', 90, 110],
                ['March', 130, 140],
                ['April', 120, 130],
                ['May', 150, 160],
                ['June', 170, 180],
                ['July', 200, 210],
                ['August', 180, 190],
                ['September', 220, 230],
                ['October', 190, 200],
                ['November', 210, 220],
                ['December', 230, 240]
            ]);

            var options = {
                title: 'Student Registration Comparison',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Month'
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
                ['Mathematics', 300],
                ['Science', 250],
                ['History', 200],
                ['English', 400],
                ['Art', 150],
                ['Physical Education', 100]
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
            var data = google.visualization.arrayToDataTable([
                ['Month', '2023', '2024'],
                ['January', 10, 12],
                ['February', 9, 11],
                ['March', 13, 14],
                ['April', 12, 13],
                ['May', 15, 16],
                ['June', 17, 18],
                ['July', 20, 21],
                ['August', 18, 19],
                ['September', 22, 23],
                ['October', 19, 20],
                ['November', 21, 22],
                ['December', 23, 24]
            ]);

            var options = {
                title: 'Teacher Registration Comparison',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Number of Registrations'
                },
                colors: ['#ff6347', '#4682b4']
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

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Students</p>
                                <h6 class="mb-0">78</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Teachers</p>
                                <h6 class="mb-0">10</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">month Revenue</p>
                                <h6 class="mb-0">LKR 21000.00</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">LKR 74570.00</h6>
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
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
