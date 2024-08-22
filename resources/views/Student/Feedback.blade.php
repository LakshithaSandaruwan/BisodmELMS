<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Feedback</title>
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
            <!-- feedback subject and text area start -->
            <div class="mt-5 container-fluid">
                <div class="row">
                    <div class="col">
                        <form action="feedbacksave" method="post">
                            @csrf

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <label for="">Subject</label>
                            <input type="text" name="subject" class="form-control">
                            <label class="mt-3" for="">Feedback</label>
                            <textarea rows="10" name="feedbacktext" id="feedbacktext" class="form-control"></textarea>
                            <input type="submit" value="save" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>