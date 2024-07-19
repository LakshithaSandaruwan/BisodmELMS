<nav class="navbar bg-light navbar-light">
    <a href="index.html" class="navbar-brand mx-4 mb-3">
        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
    </a>
    <div class="d-flex align-items-center ms-4 mb-4">
        <div class="position-relative">
            <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
        </div>
        <div class="ms-3">
            <h6 class="mb-0">Jhon Doe</h6>
            <span>Admin</span>
        </div>
    </div>
    <div class="navbar-nav w-100">
        <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user-plus"
                    aria-hidden="true"></i>Teacher</a>
            <div class="dropdown-menu bg-transparent border-0">
                <a href="/teacher" class="dropdown-item">Registration</a>
                <a href="typography.html" class="dropdown-item">All teachers</a>
            </div>
        </div>

        <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Students</a>
        <a href="batch" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Batches</a>
        <a href="grades" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Grades</a>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user-plus"
                    aria-hidden="true"></i>Subjects</a>
            <div class="dropdown-menu bg-transparent border-0">
                <a href="/subject" class="dropdown-item">Subject manage</a>
                <a href="setsubjects" class="dropdown-item">Set subjects</a>
            </div>
        </div>
    </div>
</nav>
