@extends('web.layouts.base')

@section('content')

    <!-- Head  block -->
    <section class="masthead page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="page-header-content pt-10">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-up">
                        <h1 class="page-header-title">We build huts,<br>beautiful sites<br>and cool applications</h1>
                        <p class="page-header-text mb-5">We are a team of patients on the head of psychopaths who are ready to take on any dirty work</p>
                        <a class="btn btn-teal btn-marketing rounded-pill lift lift-sm" href="landing-multipurpose.html">
                            Portfolio<svg class="svg-inline--fa fa-arrow-right fa-w-14 ml-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg><!-- <i class="fas fa-arrow-right ml-1"></i> --></a>
                        <a class="btn btn-link btn-marketing" href="https://docs.startbootstrap.com/sb-ui-kit-pro/quickstart">About us</a>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="50"><img class="img-fluid" src="images/drawkit-content-man-color.svg"></div>
                </div>
            </div>
        </div>

        <div class="svg-border-rounded text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
        </div>
    </section>

    <!-- Portfolio -->
    <section class="content-section" id="portfolio">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Portfolio</h3>
                <h2 class="mb-5">Recent Projects</h2>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#">
            <span class="caption">
              <span class="caption-content">
                <h2>Stationary</h2>
                <p class="mb-0">A yellow pencil with envelopes on a clean, blue backdrop!</p>
              </span>
            </span>
                        <img class="img-fluid" src="images/portfolio-1.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#">
            <span class="caption">
              <span class="caption-content">
                <h2>Ice Cream</h2>
                <p class="mb-0">A dark blue background with a colored pencil, a clip, and a tiny ice cream cone!</p>
              </span>
            </span>
                        <img class="img-fluid" src="images/portfolio-2.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#">
            <span class="caption">
              <span class="caption-content">
                <h2>Strawberries</h2>
                <p class="mb-0">Strawberries are such a tasty snack, especially with a little sugar on top!</p>
              </span>
            </span>
                        <img class="img-fluid" src="images/portfolio-3.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a class="portfolio-item" href="#">
            <span class="caption">
              <span class="caption-content">
                <h2>Workspace</h2>
                <p class="mb-0">A yellow workspace with some scissors, pencils, and other objects.</p>
              </span>
            </span>
                        <img class="img-fluid" src="images/portfolio-4.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="content-section bg-white" id="about">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
                    <p class="lead mb-5">This theme features a flexible, UX friendly sidebar menu and stock photos from
                        our friends at
                        <a href="https://unsplash.com/">Unsplash</a>!</p>
                    <a class="btn btn-dark btn-xl js-scroll-trigger" href="#services">What We Offer</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="content-section bg-primary text-white text-center" id="services">
        <div class="container">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0">Services</h3>
                <h2 class="mb-5">What We Offer</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-screen-smartphone"></i>
          </span>
                    <h4>
                        <strong>Responsive</strong>
                    </h4>
                    <p class="text-faded mb-0">Looks great on any screen size!</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-pencil"></i>
          </span>
                    <h4>
                        <strong>Redesigned</strong>
                    </h4>
                    <p class="text-faded mb-0">Freshly redesigned for Bootstrap 4.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-like"></i>
          </span>
                    <h4>
                        <strong>Favorited</strong>
                    </h4>
                    <p class="text-faded mb-0">Millions of users
                        <i class="fas fa-heart"></i>
                        Start Bootstrap!</p>
                </div>
                <div class="col-lg-3 col-md-6">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-mustache"></i>
          </span>
                    <h4>
                        <strong>Question</strong>
                    </h4>
                    <p class="text-faded mb-0">I mustache you a question...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Callout -->
    <section class="callout">
        <div class="container text-center">
            <h2 class="mx-auto mb-5">Welcome to
                <em>your</em>
                next website!</h2>
            <a class="btn btn-primary btn-xl" href="https://startbootstrap.com/template-overviews/stylish-portfolio/">Download
                Now!</a>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="content-section bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">The buttons below are impossible to resist...</h2>
            <a href="#" class="btn btn-xl btn-light mr-4">Click Me!</a>
            <a href="#" class="btn btn-xl btn-dark">Look at Me!</a>
        </div>
    </section>

@endsection
