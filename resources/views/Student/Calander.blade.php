<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')

    <!-- Include FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        /* Ensure events are visible */
        .fc-event {
            background-color: #378006; /* Dark green */
            color: white;
        }
        #timetable_calendar {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }
    </style>
    <!-- Include FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('timetable_calendar');
            var timetable = @json($timetable);

            // Convert timetable data to FullCalendar events
            var events = timetable.map(function(item) {
                // Map the day to an index
                var dayIndex = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'].indexOf(item.day);
                var currentDay = new Date().getDay();
                var dayDifference = (dayIndex + 7 - currentDay) % 7;
                var nextOccurrence = new Date();
                nextOccurrence.setDate(nextOccurrence.getDate() + dayDifference);

                var start = new Date(nextOccurrence);
                start.setHours(parseInt(item.StartTime.split(':')[0]), parseInt(item.StartTime.split(':')[1]));

                var end = new Date(nextOccurrence);
                end.setHours(parseInt(item.EndTime.split(':')[0]), parseInt(item.EndTime.split(':')[1]));

                return {
                    title: item.subject_name,
                    start: start.toISOString(),
                    end: end.toISOString(),
                    url: item.zoom_link,
                    recurrenceRule: `FREQ=WEEKLY;BYDAY=${item.day.substr(0, 2).toUpperCase()}` // Recurrence rule for weekly events
                };
            });

            console.log('Events:', events); // Debug: Check the events array

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: events,
                eventContent: function(arg) {
                    return { html: `<b>${arg.event.title}</b>` };
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Prevent default action

                    if (info.event.url) {
                        window.open(info.event.url, '_blank'); // Open link in new tab
                    }
                }
            });

            calendar.render();
        });
    </script>
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="col-md-12">
                <h2 class="text-center">Timetable</h2>
                <div id="timetable_calendar"></div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
</body>
</html>
