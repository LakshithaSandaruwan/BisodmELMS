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
                <div class="row mt-5 mb-5 justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- Heading Teacher --}}
                            <div class="card-header text-center">
                                <h3>Teacher Registration Form</h3>
                            </div>
                            <div class="row">
                                

                                <div class="row">
                                    <form action="teacherRegistration" method="POST">
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
                                                        <input type="text" name="teacher_initial"
                                                            id="teacher_initial" class="form-control"
                                                            placeholder="ex, D.P" value="{{ old('teacher_initial') }}">
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="teacher_lastname" class="fw-bold">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="teacher_Lastname"
                                                            id="teacher_Lastname" class="form-control"
                                                            placeholder="ex, Ranjani" value="{{ old('teacher_Lastname') }}">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label for="teacher_fullname" class="fw-bold">Full Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="teacher_fullname"
                                                            id="teacher_fullname" class="form-control"
                                                            placeholder="ex, Deva Pushpa Ranjani" value="{{ old('teacher_fullname') }}">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-4">
                                                        <label for="teachergender" class="fw-bold">Gender <span
                                                                class="text-danger">*</span></label>
                                                        <select name="teacher_gender" id="teacher_gender"
                                                            class="form-control">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male" value="{{ old('teacher_gender') }}">Male</option>
                                                            <option value="Female" value="{{ old('teacher_gender') }}">Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="teacher_bday" class="fw-bold">Birthday <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" name="teacher_birthday"
                                                            id="teacher_birthday" class="form-control" value="{{ old('teacher_birthday') }}">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-4">
                                                        <label for="T_NIC" class="fw-bold">NIC Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="T_NIC" id="T_NIC"
                                                            class="form-control" placeholder="ex, 199734503580" value="{{ old('T_NIC') }}">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-10">
                                                        <label for="study qulification" class="fw-bold">Study
                                                            Qulification
                                                        </label>
                                                        <input type="text" name="study_qulification"
                                                            id="study_qulification" class="form-control"
                                                            placeholder="ex, Rajarata University Management Degree" value="{{ old('study_qulification') }}">
                                                    </div>
                                                </div>

                                                <div>
                                                    <hr>
                                                    <h4>Contact Information</h4>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="T_contact" class="fw-bold">Contact Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" name="T_number" id="T_number"
                                                            class="form-control" placeholder="ex, 0779868982" value="{{ old('T_number') }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="T_email" class="fw-bold">E-mail <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="T_email"
                                                            class="form-control" placeholder="ex, pushpa@gmail.com" value="{{ old('email') }}">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <label for="address" class="fw-bold">Address<span
                                                            class="text-danger">*</span></label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="T_housenumber" class="fw">House Number</label>
                                                        <input type="text" name="T_housenumber" id="T_housenumber"
                                                            placeholder="ex, 215/A" value="{{ old('T_housenumber') }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="T_streetaddress" class="fw">Street Address
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" name="T_streetaddress"
                                                            id="T_streetaddress" class="form-control"
                                                            placeholder="ex, Oruthota Road" value="{{ old('T_streetaddress') }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-4">
                                                        <label for="T_district" class="fw-bold">District <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="T_district" id="T_district"
                                                            class="form-control" placeholder="ex, Gampaha" value="{{ old('T_district') }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="T_province" class="fw-bold">Province <span
                                                                class="text-danger">*</span></label>
                                                        <select name="T_province" id="T_province"
                                                            class="form-control">
                                                            <option value="">Select Province</option>
                                                            <option value="Central Province" value="{{ old('T_province') }}">Central Province</option>
                                                            <option value="Eastern Province" value="{{ old('T_province') }}">Eastern Province</option>
                                                            <option value="North Central Province" value="{{ old('T_province') }}">North Central
                                                                Province
                                                            </option>
                                                            <option value="Northern Province" value="{{ old('T_province') }}">Northern Province
                                                            </option>
                                                            <option value="North Western Province" value="{{ old('T_province') }}">North Western
                                                                Province
                                                            </option>
                                                            <option value="Sabaragamuwa Province" value="{{ old('T_province') }}">Sabaragamuwa Province
                                                            </option>
                                                            <option value="Southern Province" value="{{ old('T_province') }}">Southern Province
                                                            </option>
                                                            <option value="Uva Province" value="{{ old('T_province') }}">Uva Province</option>
                                                            <option value="Western Province" value="{{ old('T_province') }}">Western Province</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-5 mt-5">
                                                    <div class="col">
                                                        <div class="d-grid gap-2">
                                                            <button class="btn btn-primary"
                                                                type="submit">Register</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
