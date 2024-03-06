<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
        <div class="row mt-5 justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    {{-- Heading Student Registration  --}}
                    <div class="row">
                        <div class="text-center">
                            <h3>Student Registration Form</h3>
                        </div>

                        <div class="row ">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="row">
                                        <hr>
                                        <h4>Basic Information</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="" class="fw-bold">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="FullName" id="FullName" class="form-control"
                                                placeholder="ex, Lakshitha Sandaruwan">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="Gender" class="fw-bold">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select name="Gender" id="Gender" required class="form-control">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label for="birthday" class="fw-bold">Birthday <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="birthday" id="birthday" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-8">
                                            <label for="School" class="fw-bold">School <span class="text-danger">*</span></label>
                                            <input type="text" name="school" class="form-control" placeholder="ex,">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="Grade" class="fw-bold">Grade <span class="text-danger">*</span></label>
                                            <select name="Grade" id="grade" class="form-control">
                                                <option value="">Select Grade</option>
                                                <option value="Grade 1">Grade 1</option>
                                                <option value="Grade 2">Grade 2</option>
                                                <option value="Grade 3">Grade 3</option>
                                                <option value="Grade 4">Grade 4</option>
                                                <option value="Grade 5">Grade 5</option>
                                                <option value="Grade 6">Grade 6</option>
                                                <option value="Grade 7">Grade 7</option>
                                                <option value="Grade 8">Grade 8</option>
                                                <option value="Grade 9">Grade 9</option>
                                                <option value="Grade 10">Grade 10</option>
                                                <option value="Grade 11">Grade 11</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-10">
                                    <div class="row">
                                        <hr>
                                        <h4>Contact Information</h4>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="Contact" class="fw-bold">Contact <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Contact" id="Contact"
                                                placeholder="ex 0774352627" class="form-control">
                                        </div>

                                        <div class="col-4">
                                            <label for="Email" class="Fw-bold">E-mail <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="Email" id="Email" class="form-control"
                                                placeholder="ex, abc@mail.com">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
