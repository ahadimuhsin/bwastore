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
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/logo.svg') }}"/>


    <title>@yield('title')</title>

    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
    <!-- Navigation -->
    @include('includes.navbar')

    {{-- Content --}}
    @yield('content')
    {{-- Footer --}}
    @include('includes.footer')

    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
