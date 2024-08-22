<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
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
                            <h6 class="mb-4">Subject Details</h6>
                            <form action="savesubject" method="post">
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
                                    <label for="subjectname" class="form-label">Subject name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="subjectname" class="form-control" id="subjectname"
                                        aria-describedby="subjectname" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">All Subjects</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Subject name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <th scope="row">{{ $subject->id }}</th>
                                            <td>{{ $subject->subject_name }}</td>
                                            <td><a href="/deletesubject/{{ $subject->id }}">Delete</a>
                                                /
                                                <a href="#" class="edit-subject-btn" data-id="{{$subject->id}}"
                                                    data-subject_name="{{$subject->subject_name}}" data-bs-toggle="modal"
                                                    data-bs-target="#editSubjectModal">Update</a>
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

        <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editSubjectForm" action="subjectedit" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="edit-subject-id" name="Subid">
                            <div class="mb-3">
                                <label for="edit-subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="edit-subject" name="subject" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.edit-subject-btn').on('click', function() {
                    // Get data attributes
                    var subjectId = $(this).data('id');
                    var subjectName = $(this).data('subject_name');

                    // Set modal fields
                    $('#edit-subject-id').val(subjectId);
                    $('#edit-subject').val(subjectName);
                });
            });
        </script>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
