<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
        <!-- Navigation -->
        <nav
        class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
        data-aos="fade-down"
      >
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="/images/logo.svg" alt="" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">Home </a>
              </li>
              <li class="nav-item {{ Request::is('categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categories') }}">Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Rewards</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    {{-- Content --}}
    @yield('content')
    {{-- Footer --}}
    @include('includes.footer')

    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
