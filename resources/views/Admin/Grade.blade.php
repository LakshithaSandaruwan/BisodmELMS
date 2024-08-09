<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Subject Details</h6>
                            <form action="savegrade" method="post">
                                @csrf
                                <!-- Success Message -->
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

                                <div class="mb-3">
                                    <label for="gradename" class="form-label">Grade<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="gradename" class="form-control" id="gradename"
                                        aria-describedby="gradename" required>
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
                                        <th scope="col">Grade</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades as $grade)
                                        <tr>
                                            <th scope="row">{{ $grade->id }}</th>
                                            <td>Grade {{ $grade->Grade }}</td>
                                            <td>
                                                <a href="#" class="edit-grade-btn" data-id="{{ $grade->id }}"
                                                    data-name="{{ $grade->Grade }}">Update</a>
                                                /
                                                <a href="{{ route('delete.grade', $grade->id) }}"
                                                    class="delete-grade-btn">Delete</a>
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

        <div class="modal fade" id="editGradeModal" tabindex="-1" aria-labelledby="editGradeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGradeModalLabel">Edit Grade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editGradeForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-grade" class="form-label">Grade</label>
                                <input type="text" class="form-control" id="edit-grade" name="Grade" required>
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
                // Handle the click event for the edit button
                $('body').on('click', '.edit-grade-btn', function() {
                    var gradeId = $(this).data('id');
                    var gradeName = $(this).data('name');

                    // Populate the modal form with the current grade data
                    $('#edit-grade').val(gradeName);
                    $('#editGradeForm').attr('action', '/updateGrade/' + gradeId);

                    // Show the modal
                    $('#editGradeModal').modal('show');
                });

                // Handle the delete confirmation
                $('body').on('click', '.delete-grade-btn', function(event) {
                    event.preventDefault();
                    var deleteUrl = $(this).attr('href');
                    if (confirm('Are you sure you want to delete this grade?')) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        </script>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
