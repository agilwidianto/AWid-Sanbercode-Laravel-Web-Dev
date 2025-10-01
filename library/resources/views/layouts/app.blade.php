<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title','Library')</title>

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  {{-- Global CSS (sticky footer, disabled link, spacing) --}}
  <style>
    html, body { height: 100%; margin: 0; padding: 0; }
    body { display: flex; flex-direction: column; min-height: 100vh; font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif; }
    main { flex: 1 0 auto; }              /* konten mengisi area di atas footer */
    .site-footer { margin-top: auto; border-top: 1px solid #e5e7eb; background: #fff; padding: 12px 0; }
    .nav-link.disabled { pointer-events: none; opacity: .45; }
    .logo { letter-spacing: .5px; }
    .book-cover{
      display:block;
      max-width:150px;   /* kecil */
      height:auto;       /* proporsional */
      margin:10px auto;  /* center */
    }
  </style>

  @stack('styles')
</head>
<body>

  {{-- NAVBAR --}}
  <header id="header" class="site-header border-bottom">
    <nav id="header-nav" class="navbar navbar-expand-lg py-3">
      <div class="container">
        <a class="navbar-brand logo m-0 fw-bold"
           href="{{ auth()->check() ? route('dashboard') : route('login') }}">
          LIBRARY<span class="text-primary">.</span>
        </a>

        <button class="navbar-toggler d-flex d-lg-none order-3 p-2" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#bdNavbar"
                aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
          <div class="offcanvas-header px-4 pb-0">
            <h5 class="mb-0">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
          </div>

          <div class="offcanvas-body">
            {{-- Left menu --}}
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('genres.*') ? 'active fw-bold' : '' }}" 
                  href="{{ route('genres.index') }}">
                  Genres
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('books.*') ? 'active fw-bold' : '' }}" 
                  href="{{ route('books.index') }}">
                  Books
                </a>
              </li>
            </ul>

            {{-- Right area --}}
            <div class="d-flex">
              @auth
                <div class="me-3">Hello, <strong>{{ auth()->user()->name }}</strong></div>

                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary me-2">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="btn btn-outline-danger">Logout</button>
                </form>
              @endauth
              {{-- @guest: tidak menampilkan tombol Login/Register sesuai permintaan --}}
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  {{-- FLASH MESSAGE --}}
  <div class="container mt-3">
    @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  {{-- MAIN CONTENT --}}
  <main>
    @yield('content')
  </main>

  {{-- FOOTER (sticky, tanpa ruang kosong) --}}
  <footer id="footer-bottom" class="site-footer text-center">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Company</strong> All Rights Reserved
      </div>
    </div>
  </footer>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  @stack('scripts')
</body>
</html>
