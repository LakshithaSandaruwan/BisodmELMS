<nav class="navbar bg-light navbar-light">
    <a href="/home" class="navbar-brand mx-4 mb-3">
        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Teacher</h3>
    </a>
    <div class="d-flex align-items-center ms-4 mb-4">
        <div class="position-relative">
            <img class="rounded-circle" src="img/teacher.png" alt="" style="width: 40px; height: 40px;">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
        </div>
        <div class="ms-3">
            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
            <span>Teacher</span>
        </div>
    </div>
    <div class="navbar-nav w-100">
        <a href="/home" class="nav-item nav-link {{ Request::is('home') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="/ongoingclasses" class="nav-item nav-link {{ Request::is('ongoingclasses') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Ongoing Classes</a>
        <a href="/homeworks" class="nav-item nav-link {{ Request::is('homeworks') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Homeworks</a>
        <a href="/ViewQuizes" class="nav-item nav-link {{ Request::is('ViewQuizes') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Quizes</a>
        <a href="/ViewZoomLinks" class="nav-item nav-link {{ Request::is('ViewZoomLinks') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Access Classes</a>
    </div>
</nav>
