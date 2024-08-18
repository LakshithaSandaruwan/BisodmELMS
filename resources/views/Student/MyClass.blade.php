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
        

        <div class="sidebar pe-4 pb-3">
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="overflow-hidden card table-nowrap table-card mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Home works</h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Subject</th>
                                <th>Deadline</th>
                                <th>Assignment</th>
                                <th>Submission</th>
                                <th>Upload</th>
                                <th>Results</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($homeworkDetails as $homeworkDetail)
                                <tr class="align-middle">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="h6 mb-0 lh-1">{{ $homeworkDetail->subject_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td> {{ $homeworkDetail->deadline }}</td>
                                    <td> <span class="d-inline-block align-middle"><a
                                                href="#{{ $homeworkDetail->file_path }}">Download</a></span>
                                    </td>
                                    <td>
                                        @if ($homeworkDetail->submission_file_path == null)
                                            <p class="fw-bold text-danger">Yet to submit</p>
                                        @else
                                            <a href="/{{ $homeworkDetail->submission_file_path }}">View</a>
                                        @endif
                                    </td>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#homeworksubmission"
                                            class="btn btn-primary"
                                            data-homework-id="{{ $homeworkDetail->homework_id }}"
                                            data-subject-id="{{ $homeworkDetail->subject_id }}">
                                            Submit
                                        </a>
                                    </td>
                                    <td>{{ $homeworkDetail->results }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <div class="modal fade" id="homeworksubmission" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Homeworks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="submithomework" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="homework-id" name="homework_id">
                        <input type="hidden" id="subject-id" name="subject_id">
                        <label for="file" class="form-label">Select the homework file (pdf, docx, ppt)<span
                                class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control" id="file" aria-describedby="file"
                            required accept=".pdf,.docx,.ppt">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var homeworkSubmissionModal = document.getElementById('homeworksubmission');
            homeworkSubmissionModal.addEventListener('show.bs.modal', function(event) {
                // Button that triggered the modal
                var button = event.relatedTarget;
                // Extract info from data-* attributes
                var homeworkId = button.getAttribute('data-homework-id');
                var subjectId = button.getAttribute('data-subject-id');

                // Update the modal's hidden input fields
                var modalHomeworkIdInput = homeworkSubmissionModal.querySelector('#homework-id');
                var modalSubjectIdInput = homeworkSubmissionModal.querySelector('#subject-id');

                modalHomeworkIdInput.value = homeworkId;
                modalSubjectIdInput.value = subjectId;
            });
        });
    </script>

    @include('CDNs.AdminJS')
</body>

</html>
