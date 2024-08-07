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
        <div class="row mt-5 mb-3 justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    {{-- Heading Student Registration  --}}
                    <form method="POST" action="{{ route('register') }}">
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
                        <div class="row">
                            <div class="text-center">
                                <h3 class="fw-bold">Student Registration Form</h3>
                            </div>

                            <div class="row ">
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
                                                <input type="text" name="Initial" id="Initial" class="form-control"
                                                    placeholder="ex, A.L" value="{{ old('Initial') }}">
                                            </div>
                                            <div class="col-6">
                                                <label for="name" class="fw-bold">Last Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="ex, Sandaruwan" value="{{ old('name') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label for="" class="fw-bold">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="FullName" id="FullName"
                                                    class="form-control"
                                                    placeholder="ex, Agampodi Lakshitha Sandaruwan" value="{{ old('FullName') }}">
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
                                                <input type="date" name="birthday" id="birthday"
                                                    class="form-control" value="{{ old('birthday') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-8">
                                                <label for="School" class="fw-bold">School <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="school" class="form-control"
                                                    placeholder="ex, Bandranayake Central College" value="{{ old('school') }}">
                                            </div>
                                            <div class="col-4">
                                                <label for="city" class="fw-bold">City <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="City" id="City" class="form-control"
                                                    placeholder="ex, Veyangoda" value="{{ old('city') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label for="Grade" class="fw-bold">Grade <span
                                                        class="text-danger">*</span></label>
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
                                        </div> {{-- Finish Basic Informatin --}}

                                        <div class="row mt-5">
                                            <hr>
                                            <h4>Contact Information</h4>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <label for="Contact" class="fw-bold">Contact Number<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="ContactNumber" id="Contact"
                                                    placeholder="ex 0774352627" class="form-control" value="{{ old('ContactNumber') }}">
                                            </div>
                                            <div class="col-4">
                                                <label for="Email" class="fw-bold">E-mail <span
                                                        class="text-danger">*</span></label>

                                                <input id="Email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="Email">

                                                @error('Email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <label for="address" class="fw-bold">Address <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <label for="HouseNumber" class="fw">House Number</label>
                                                <input type="text" name="HouseNumber" id="HouseNumber"
                                                    class="form-control" placeholder="ex, 174/B" value="{{ old('HouseNumber') }}">
                                            </div>
                                            <div class="col-6">
                                                <label for="Street" class="fw">Street Address <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="StreetAdress" id="StreetAdress"
                                                    class="form-control" placeholder="ex, Oruthota" value="{{ old('StreetAdress') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label for="city" class="fw-bold">District <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="District" id="District"
                                                    class="form-control" placeholder="ex, Gampaha" value="{{ old('District') }}">
                                            </div>
                                            <div class="col-4">
                                                <label for="province" class="fw-bold">Province <span
                                                        class="text-danger">*</span></label>
                                                <select name="province" id="province" class="form-control">
                                                    <option value="">Select Province</option>
                                                    <option value="Central Province">Central Province</option>
                                                    <option value="Eastern Province">Eastern Province</option>
                                                    <option value="North Central Province">North Central Province
                                                    </option>
                                                    <option value="Northern Province">Northern Province</option>
                                                    <option value="North Western Province">North Western Province
                                                    </option>
                                                    <option value="Sabaragamuwa Province">Sabaragamuwa Province
                                                    </option>
                                                    <option value="Southern Province">Southern Province</option>
                                                    <option value="Uva Province">Uva Province</option>
                                                    <option value="Western Province">Western Province</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <hr>
                                            <h4>Parents/Guardian Information</h4>
                                        </div>

                                        <div class="row">
                                            <div class="col-10">
                                                <label for="Full Name" class="fw-bold">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="ParentFullName" id="FullName"
                                                    class="form-control" placeholder="ex, Dewa Pushpa Ranjani" value="{{ old('ParentFullName') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label for="Gender" class="fw-bold">Gender<span
                                                        class="text-danger">*</span></label>
                                                <select name="ParentGender" id="Gender" class="form-control">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="ParentBirthday" class="fw-bold">Birthday <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="ParentBirthday" id="ParentBirthday"
                                                    class="form-control" value="{{ old('ParentBirthday') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <label for="NIC Number" class="fw-bold">NIC Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="NIC" id="NIC"
                                                    class="form-control" placeholder="ex, 674573865V" value="{{ old('NIC') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-3 mb-3">
                                            <div class="col-4">
                                                <label for="ParentContactNumber" class="fw-bold">Contact Number <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="PNumber" id="PNumber"
                                                    class="form-control" placeholder="ex, 0754738543" value="{{ old('PNumber') }}">
                                            </div>

                                            <div class="col-4">
                                                <label for="PEmail" class="fw-bold">E-mail <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="Pemail" id="Pemail"
                                                    class="form-control" placeholder="abc@gmail.com" value="{{ old('Pemail') }}">
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <hr>
                                            <h4>Login details</h4>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="password"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-5">
                                            <div class="col">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-primary" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>
