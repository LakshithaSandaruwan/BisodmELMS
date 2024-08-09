<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
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
                            <h6 class="mb-4">Batch Details</h6>
                            <form action="savebatch" method="post">
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
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
