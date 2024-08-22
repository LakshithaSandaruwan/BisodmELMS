<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


</head>

<body class="index-page">

    @include('layouts.navbar')

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">

            <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container position-relative">

                <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                    <h2>WELCOME TO {{ config('app.name', 'Laravel') }}</h2>
                    <p>Empowering Minds, Shaping Futures.</p>
                </div><!-- End Welcome -->

                <div class="content row gy-4">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                            <h3>Why Choose {{ config('app.name', 'Laravel') }}?</h3>
                            <p>
                                At BisodmELMS, we prioritize the learner's experience. Our platform is built on the
                                principles of accessibility, inclusivity, and innovation. We continually update our
                                offerings to ensure that our students have access to the latest educational tools and
                                resources. By choosing BisodmELMS, you are choosing a platform dedicated to your
                                academic and professional success.

                                Join us at BisodmELMS and take the next step in your educational journey.
                            </p>
                            <div class="text-center">
                                <a href="#about" class="more-btn"><span>Learn More</span> <i
                                        class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div><!-- End Why Box -->

                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="d-flex flex-column justify-content-center">
                            <div class="row gy-4">

                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                        <i class="bi bi-gem"></i>
                                        <h4>Vision</h4>
                                        <p>Preparing wise children enriched with good qualities that surpass the current
                                            competition</p>
                                    </div>
                                </div><!-- End Icon Box -->

                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                        <i class="bi bi-clipboard-data"></i>
                                        <h4>Mission</h4>
                                        <p>As an home school program, Bisdom Academy employs a standards-based
                                            curriculum that caters to individual differences and learning preferences.
                                            We encourage students to take responsibility of their current and future
                                            education by developing their academic, social, self-awareness, and
                                            technological abilities.</p>
                                    </div>
                                </div><!-- End Icon Box -->

                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                        <i class="bi bi-balloon-heart"></i>
                                        <h4>Values</h4>
                                        <p>We mainly focus on values of learing, Relationship, Integrity, Accoutability,
                                            Innovation and Respect</p>
                                    </div>
                                </div><!-- End Icon Box -->

                            </div>
                        </div>
                    </div>
                </div><!-- End  Content-->

            </div>

        </section>

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4 gx-5">

                    <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                        <img src="img/logo.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <h3>About Us</h3>
                        <p>
                            Welcome to Bisdom Academy, where our primary goal is to make education accessible
                            for low-income students. Established in 2024, we are dedicated to providing resources,
                            tools, and support tailored to the unique needs of students facing financial challenges.
                        </p>

                        <p>
                            At Bisdom Academy, we understand that financial constraints can often limit educational opportunities.
                            That's why we offer a comprehensive range of free and low-cost educational materials,
                            including interactive lessons, tutoring, and study aids designed to help students succeed academically
                            without the burden of additional costs.
                        </p>

                        <p>
                            Our platform is designed with you in mind. Whether you're in elementary school,
                            high school, or pursuing higher education, we provide resources that cater to various educational
                            levels and subjects. Our team of educators and mentors is committed to creating an inclusive environment
                            where every student can thrive, regardless of their economic background.
                        </p>

                        <p>
                            We partner with schools, community organizations, and volunteers to ensure that our resources are both relevant
                            and accessible. Our mission is to support and empower students, helping them to achieve their full potential and
                            overcome the barriers posed by financial limitations.
                        </p>

                        <p>
                            Thank you for choosing Bisdom Academy. We are honored to be part of your educational journey and are here to support
                            you every step of the way.
                        </p>
                        <!-- <ul>
                            <li>
                                <i class="fa-solid fa-vial-circle-check"></i>
                                <div>
                                    <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                                    <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade
                                    </p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-pump-medical"></i>
                                <div>
                                    <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                                    <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna
                                        pasata redi</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-heart-circle-xmark"></i>
                                <div>
                                    <h5>Voluptatem et qui exercitationem</h5>
                                    <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime
                                        veniam</p>
                                </div>
                            </li>
                        </ul> -->
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
                        <h3>Feedback</h3>
                        <p>
                            Explore what our students have to say about their experiences at Bisdom Academy.
                            Their feedback highlights our commitment to excellence and continuous improvement in providing
                            a top-quality education.
                        </p>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

                        <div class="swiper init-swiper">
                            <script type="application/json" class="swiper-config">
                                {
                                    "loop": true,
                                    "speed": 600,
                                    "autoplay": {
                                        "delay": 5000
                                    },
                                    "slidesPerView": "auto",
                                    "pagination": {
                                        "el": ".swiper-pagination",
                                        "type": "bullets",
                                        "clickable": true
                                    }
                                }
                            </script>
                            <div class="swiper-wrapper">

                                @foreach($feedbacks as $feedback)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assets/img/testimonials/testimonials-1.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>{{$feedback->fullname}}</h3>
                                                <h4>{{$feedback->Subject}}</h4>
                                                <!-- <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div> -->
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>{{$feedback->Feedback}}</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->
                                @endforeach


                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <footer id="footer" class="footer light-background">

            <div class="container footer-top">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">BisdomELMS</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>115/A, Oruthota Road</p>
                            <p>Gampaha.</p>
                            <p>Sri Lanka.</p>
                            <p class="mt-3"><strong>Phone:</strong> <span>+94 33 223 6224</span></p>
                            <p><strong>Email:</strong> <span>bisdomelms@gmail.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    
                    

                    

                    

                </div>
            </div>

            <div class="container copyright text-center mt-4">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">BisdomELMS</strong> <span>All Rights
                        Reserved</span></p>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    
                </div>
            </div>

        </footer>

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

        <!-- Main JS File -->
        <script src="assets/js/main.js"></script>

</body>

</html>