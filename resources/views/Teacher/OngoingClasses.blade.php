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
                                <h5 class="mb-0">Ongoing Classes</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="small text-uppercase bg-body text-muted">
                                        <tr>
                                            <th>Batch</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                            <th>Class End</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                            <tr class="align-middle">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div class="h6 mb-0 lh-1">{{ $class->batch_name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Grade {{ $class->grade_name }}</td>
                                                <td> <span
                                                        class="d-inline-block align-middle">{{ $class->subject_name }}</span>
                                                </td>
                                                <td><a href="/endClass/{{ $class->id }}">End the Class</a></td>
                                                <td class="text-end">
                                                    <div class="drodown">
                                                        <a data-bs-toggle="dropdown" href="#" class="btn p-1"
                                                            aria-expanded="false">
                                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a href="/BatchStudents/{{ $class->id }}"
                                                                class="dropdown-item">View Students</a>
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#homeworkmodel" class="dropdown-item"
                                                                data-subject-id="{{ $class->id }}">Add Homeworks</a>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#quizmodel" class="dropdown-item"
                                                                data-quiz-id="{{ $class->id }}">New Quiz</a>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#zoomlink" class="dropdown-item"
                                                                data-link-id="{{ $class->id }}">Add Zoom classes
                                                                links</a>

                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#materials" class="dropdown-item"
                                                                data-subject-id="{{ $class->id }}">Study
                                                                Materials</a>
                                                        </div>
                                                    </div>
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

        <!-- Modal -->
        <div class="modal fade" id="quizmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Homeworks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="savequiz" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="subject-id" name="subject_id">

                            <label for="file" class="form-label">Quiz name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name" required>

                            <label for="deadline" class="form-label mt-4">Deadline<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="deadline" class="form-control" id="deadline"
                                aria-describedby="deadline" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- study materials --}}
        <div class="modal fade" id="materials" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Study Materials</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="saveMaterials" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="subject-id" name="subject_id">
                            <label for="file" class="form-label">Select the file (pdf, docx, ppt)<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="file"
                                aria-describedby="file" required accept=".pdf,.docx,.ppt">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="homeworkmodel" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Homeworks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="savehomeworks" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="subject-id" name="subject_id">
                            <label for="file" class="form-label">Select the homework file (pdf, docx, ppt)<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" id="file"
                                aria-describedby="file" required accept=".pdf,.docx,.ppt">
                            <label for="deadline" class="form-label mt-4">Deadline<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="deadline" class="form-control" id="deadline"
                                aria-describedby="deadline" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="zoomlink" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add zoom links</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="savelink" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="subject-id" name="subject_id">

                            <label for="link" class="form-label mt-4">Link<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="link" class="form-control" id="link"
                                aria-describedby="link" required>

                            <label for="Day" class="form-label mt-2">Day<span
                                    class="text-danger">*</span></label>
                            <select name="Day" class="form-control" id="Day" aria-describedby="Day"
                                required>
                                <option value="">Select a day</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                            <label for="stime" class="form-label mt-2">Start time<span
                                    class="text-danger">*</span></label>
                            <input type="time" name="stime" class="form-control" id="stime"
                                aria-describedby="stime" required>

                            <label for="etime" class="form-label mt-2">End Time<span
                                    class="text-danger">*</span></label>
                            <input type="time" name="etime" class="form-control" id="etime"
                                aria-describedby="etime" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var homeworkModal = document.getElementById('zoomlink');
            homeworkModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var subjectId = button.getAttribute(
                    'data-link-id');
                var modal = homeworkModal;
                modal.querySelector('#subject-id').value = subjectId;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var homeworkModal = document.getElementById('homeworkmodel');
            homeworkModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var subjectId = button.getAttribute(
                    'data-subject-id');
                var modal = homeworkModal;
                modal.querySelector('#subject-id').value = subjectId;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var homeworkModal = document.getElementById('quizmodel');
            homeworkModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var subjectId = button.getAttribute(
                    'data-quiz-id');
                var modal = homeworkModal;
                modal.querySelector('#subject-id').value = subjectId;
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var matmodal = document.getElementById('materials');
            matmodal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var subjectId = button.getAttribute(
                    'data-subject-id');
                var modal = matmodal;
                modal.querySelector('#subject-id').value = subjectId;
            });
        });
    </script>


    @include('CDNs.AdminJS')
</body>

</html>
