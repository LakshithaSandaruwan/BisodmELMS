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
                ['Math', 90],
                ['Science', 85],
                ['History', 80],
                ['English', 95],
                ['Art', 70]
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
                                <h6 class="mb-0">5</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-calendar-check fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Attendance Rate</p>
                                <h6 class="mb-0">90%</h6>
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

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Attendance Record</h2>
                        <div id="attendance_record_chart" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Upcoming Deadlines</h2>
                        <ul class="list-group">
                            <li class="list-group-item">Assignment 1: Math - Due 10th August</li>
                            <li class="list-group-item">Project: Science Fair - Due 20th August</li>
                            <li class="list-group-item">Essay: History - Due 25th August</li>
                            <li class="list-group-item">Art Exhibition Submission - Due 30th August</li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Submitted Homework</h2>
                        <ul class="list-group">
                            <li class="list-group-item">Math Assignment 1 - Submitted</li>
                            <li class="list-group-item">Science Project Proposal - Submitted</li>
                            <li class="list-group-item">History Essay - Pending</li>
                            <li class="list-group-item">English Book Report - Submitted</li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Announcements</h2>
                        <div class="alert alert-info" role="alert">
                            Midterm exams start next week. Please check the schedule.
                        </div>
                        <div class="alert alert-info" role="alert">
                            The library will be closed for renovations from 1st August to 15th August.
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2 class="text-center">Timetable</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>9:00 - 10:00</th>
                                    <th>10:00 - 11:00</th>
                                    <th>11:00 - 12:00</th>
                                    <th>12:00 - 1:00</th>
                                    <th>1:00 - 2:00</th>
                                    <th>2:00 - 3:00</th>
                                    <th>3:00 - 4:00</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Monday</td>
                                    <td>Math</td>
                                    <td>Science</td>
                                    <td>History</td>
                                    <td>Lunch Break</td>
                                    <td>English</td>
                                    <td>Art</td>
                                    <td>Physical Education</td>
                                </tr>
                                <tr>
                                    <td>Tuesday</td>
                                    <td>Science</td>
                                    <td>Math</td>
                                    <td>Art</td>
                                    <td>Lunch Break</td>
                                    <td>History</td>
                                    <td>English</td>
                                    <td>Computer Science</td>
                                </tr>
                                <!-- Add more rows for other days as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
