<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Company')</title>

  {{-- Vendor CSS (B5) --}}
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  {{-- Main CSS template --}}
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <style>
    .topbar-line{height:4px;background:#333;}
    .logo a{color:#18d26e;text-decoration:none;font-weight:700;letter-spacing:.5px}
    .logo a span{color:#18d26e}
  </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="topbar-line"></div>

  {{-- ===== Header: Bootstrap 5 Navbar ===== --}}
  <header id="header" class="fixed-top bg-white">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light py-3">
        <a class="navbar-brand logo m-0" href="{{ url('/') }}">COMPANY<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                About
              </a>
              <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                <li><a class="dropdown-item" href="#">Company</a></li>
                <li><a class="dropdown-item" href="#">Team</a></li>
              </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
            <li class="nav-item">
              <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ url('/register') }}">Contact</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  {{-- ===== End Header ===== --}}

  <main id="main" class="container flex-grow-1" style="padding-top:120px;">
    <div class="text-center mb-5">
      <h3 class="section-title">@yield('page_title')</h3>
      <span class="d-inline-block" style="width:40px;height:4px;background:#18d26e;"></span>
    </div>
    @yield('content')
  </main>

  <footer id="footer" class="bg-dark text-light py-3 mt-auto">
    <div class="container text-center">
      <div class="copyright">
        &copy; Copyright <strong>Company</strong> All Rights Reserved
      </div>
    </div>
  </footer>

  {{-- Vendor JS (B5) --}}
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
