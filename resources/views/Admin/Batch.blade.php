<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Batch</title>
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
                            <h6 class="mb-4">Batch Details</h6>
                            <form action="savebatch" method="post">
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
                                    <label for="name" class="form-label">Batch Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        aria-describedby="name" required placeholder="Batch 2024">

                                    <label for="startDate" class="form-label mt-2">Batch Start date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="startDate" id="startDate" class="form-control">

                                    <label for="endtDate" class="form-label mt-2">Batch End date<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="endtDate" id="endtDate" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
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
                                        <th scope="col">Batch name</th>
                                        <th scope="col">Batch Start date</th>
                                        <th scope="col">Batch End date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($batchs as $batch)
                                    <tr>
                                        <th scope="row">{{ $batch->id }}</th>
                                        <td>{{ $batch->Year }}</td>
                                        <td>{{ $batch->StartDate }}</td>
                                        <td>{{ $batch->EndDate }}</td>

                                        <td>
                                            @if ($batch->IsStillEnrolling)
                                            <span class="badge bg-success">OnGoing</span>
                                            @else
                                            <span class="badge bg-danger">Ended</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="#" class="edit-batch-btn" data-id="{{$batch->id}}"
                                                data-batch_name="{{$batch->Year}}" data-start_date="{{$batch->StartDate}}" 
                                                data-end_date="{{$batch->EndDate}}" data-bs-toggle="modal"
                                                data-bs-target="#editbatchModal">Update</a>
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

        <div class="modal fade" id="editbatchModal" tabindex="-1" aria-labelledby="editBatchModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBatchModalLabel">Edit Batch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editBatchForm" action="batchedit" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="edit-batch-id" name="batchid">
                            <div class="mb-3">
                                <label for="edit-batch" class="form-label">Batch</label>
                                <input type="text" class="form-control" id="edit-batch" name="batch" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-bacthstartdate" class="form-label">Batch Start Date</label>
                                <input type="date" class="form-control" id="edit-batchstartdate" name="startdate" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-bacthenddate" class="form-label">Batch End Date</label>
                                <input type="date" class="form-control" id="edit-batchenddate" name="enddate" required>
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
                $('.edit-batch-btn').on('click', function() {
                    // Get data attributes
                    var batchId = $(this).data('id');
                    var batchName = $(this).data('batch_name');
                    var batchstartdate = $(this).data('start_date');
                    var batchenddate = $(this).data('end_date');

                    console.log(batchName);

                    // Set modal fields
                    $('#edit-batch-id').val(batchId);
                    $('#edit-batch').val(batchName);
                    $('#edit-batchstartdate').val(batchstartdate);
                    $('#edit-batchenddate').val(batchenddate);
                });
            });
        </script>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>