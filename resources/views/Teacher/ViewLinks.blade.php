<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Access Classes</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            @include('Teacher.Include.Sidebar')
        </div>

        <div class="content">
            @include('Teacher.Include.Navbar')
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Class links</h6>
                            <input type="text" id="search-studnts" class="form-control mb-4"
                                placeholder="Search by Subject Name">
                        
                            <table class="table mb-0">
                                <thead class="small text-uppercase bg-body text-muted">
                                    <tr>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start time</th>
                                        <th scope="col">End time</th>
                                        <th scope="col">Links</th>
                                    </tr>
                                </thead>
                                <tbody id="teacher-table-body">
                                    @foreach ($links as $link)
                                        <tr>
                                            <td>{{ $link->subject_name }} </td>
                                            <td>Grade {{ $link->Grade }}</td>
                                            <td>{{ $link->day }}</td>
                                            <td>{{ $link->StartTime }} </td>
                                            <td>{{ $link->EndTime }}</td>
                                            <td><a href="{{ $link->Links }}">Join</a></td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
