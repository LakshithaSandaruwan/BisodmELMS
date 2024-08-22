<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Class Mapping</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
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
                            <h6 class="mb-4">Class Mappings</h6>
                            <form action="subjectmapping" method="post">
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="batch" class="form-label">Batch<span
                                                    class="text-danger">*</span></label>
                                            <select name="batch" id="batch" class="form-control" required>
                                                <option value="">Select batch</option>
                                                @foreach ($batches as $batche)
                                                    <option value="{{ $batche->id }}"> {{ $batche->Year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="gradename" class="form-label">Grade<span
                                                    class="text-danger">*</span></label>
                                            <select name="grade" id="grade" class="form-control" required>
                                                <option value="">Select grade</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">Grade {{ $grade->Grade }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="subject" class="form-label">Subject<span
                                                    class="text-danger">*</span></label>
                                            <select name="subject" id="subject" class="form-control" required>
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Teacher" class="form-label">Teacher<span
                                                    class="text-danger">*</span></label>
                                            <select name="Teacher" id="Teacher" class="form-control" required>
                                                <option value="">Select the Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="filterBatch" id="filterBatch" class="form-control" required>
                                        <option value="">Select batch</option>
                                        @foreach ($batches as $batche)
                                            <option value="{{ $batche->id }}"> {{ $batche->Year }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="Grade" id="Grade" class="form-control">
                                        <option value="">Filter with grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">Grade {{ $grade->Grade }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Teacher</th>
                                    </tr>
                                </thead>
                                <tbody id="subject-mappings-tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script>
        $(document).ready(function() {
            $('#Grade').on('change', function() {
                var gradeId = $(this).val();
                var batchId = $('#filterBatch').val();

                $.ajax({
                    url: "{{ route('subject-mappings.filter') }}",
                    method: 'GET',
                    data: {
                        grade_id: gradeId,
                        batch_id: batchId
                    },
                    success: function(response) {

                        var tbody = $('#subject-mappings-tbody');
                        tbody.empty();
                        $.each(response, function(index, mapping) {
                            var row = `<tr>
                        <th scope="row">${mapping.id}</th>
                        <td>${mapping.batch_name}</td>
                        <td>Grade ${mapping.grade_name}</td>
                        <td>${mapping.subject_name}</td>
                        <td>${mapping.teacher_name}</td>
                    </tr>`;
                            tbody.append(row);
                        });
                    }
                });
            });
        });
    </script>

    @include('CDNs.AdminJS')
</body>

</html>
