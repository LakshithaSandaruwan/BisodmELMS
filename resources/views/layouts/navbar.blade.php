<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">bisdomelms@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+94 33 223 6224</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">{{ config('app.name', 'Laravel') }}</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <li><a href="{{ url('/home') }}">Home</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Log in</a></li>

                                @if (Route::has('register'))
                                    <li><a href="{{ route('Student.Registration') }}">Register</a></li>
                                @endif
                            @endauth
                        </div>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn d-none d-sm-block" href="/enrollment">Online Classes</a>

        </div>

    </div>

</header>