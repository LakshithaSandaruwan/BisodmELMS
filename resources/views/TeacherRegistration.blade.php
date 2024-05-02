<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    {{-- Heading Teacher --}}

                    <div class="row">
                        <div class="text-center">
                            <h3>Teacher Registration Form</h3>
                        </div>

                        <div class="row">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="row">
                                        <hr>
                                        <h4>Basic Information</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label for="Initial" class="fw-bold">Initial <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="teacher_initial" id="teacher_initial"
                                                class="form-control" placeholder="ex, D.P">
                                        </div>

                                        <div class="col-6">
                                            <label for="teacher_lastname" class="fw-bold">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="teacher_Lastname" id="teacher_Lastname"
                                                class="form-control" placeholder="ex, Ranjani">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label for="teacher_fullname" class="fw-bold">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="teacher_fullname" id="teacher_fullname"
                                                class="form-control" placeholder="ex, Deva Pushpa Ranjani">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="teachergender" class="fw-bold">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select name="teacher_gender" id="teacher_gender" class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="teacher_bday" class="fw-bold">Birthday <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="teacher_birthday" id="teacher_birthday"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-10">
                                            <label for="study qulification" class="fw-bold">Study Qulification </label>
                                            <input type="text" name="study_qulification" id="study_qulification" class="form-control" placeholder="ex, Rajarata University Management Degree">
                                        </div>
                                    </div>

                                    <div>
                                        <hr>
                                        <h4>Contact Information</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <label for="T_contact" class="fw-bold">Contact Number <span class="text-danger">*</span></label>
                                            <input type="number" name="T_number" id="T_number" class="form-control" placeholder="ex, 0779868982">
                                        </div>
                                        <div class="col-4">
                                            <label for="T_email" class="fw-bold">E-mail <span class="text-danger">*</span></label>
                                            <input type="email" name="T_email" id="T_email" class="form-control" placeholder="ex, pushpa@gmail.com">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <label for="address" class="fw-bold">Address<span class="text-danger">*</span></label>
                                    </div>

                                    <div class="row">
                                        <div class="col-3">
                                            <label for="T_housenumber" class="fw">House Number</label>
                                            <input type="text" name="T_housenumber" id="T_housenumber" placeholder="ex, 215/A">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
