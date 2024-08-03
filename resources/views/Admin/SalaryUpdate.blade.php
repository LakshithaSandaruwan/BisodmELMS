<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>All Teachers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <div class="sidebar pe-4 pb-3">
            @include('Admin.Include.Sidebar')
        </div>

        <div class="content">
            @include('Admin.Include.Navbar')
            <div class="container-fluid">
                <form action="/salarypayment" method="POST">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-3">
                            <label for="">Gross Salary</label>
                            <input type="text" name="gross" id="gross" class="form-control"
                                value="{{ $gross }}.00">
                        </div>
                        <div class="col-3">
                            <label for="">Insitute Pay</label>
                            <input type="text" name="insitutepay" id="insitutepay" class="form-control"
                                value="{{ $insitutePay }}">
                        </div>
                        <div class="col-3">
                            <label for="">Bonus</label>
                            <input type="text" name="bonus" id="bonus" class="form-control"
                                value="0">
                        </div>
                        <div class="col-3">
                            <label for="">Tax</label>
                            <input type="text" name="tax" id="tax" class="form-control"
                                value="0">
                            <input type="hidden" name="teacherId" id="teacherId" class="form-control"
                                value="{{ $teacherId }}">
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" value="Pay" class="btn btn-success mt-3">
                    </div>
                </form>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
