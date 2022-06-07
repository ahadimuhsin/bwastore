@extends('layouts.auth')

@section('title', 'Login')
@section('content')
<!-- Page Content -->
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center row-login">
          <div class="col-lg-6 text-center">
            <img
              src="/images/login-placeholder.png"
              alt=""
              class="w-50 mb-4 mb-lg-none"
            />
          </div>
          <div class="col-lg-5">
            <h2>
              Belanja kebutuhan utama, <br />
              menjadi lebih mudah
            </h2>
            <form class="mt-3" action="{{ route('login') }}" method="POST">
                @csrf
              <div class="form-group">
                <label>Email address</label>
                <input
                  type="email"
                  class="form-control w-75 @error('email')
                  is-invalid
                  @enderror"
                  aria-describedby="emailHelp"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  autocomplete
                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control w-75 @error('email')
                is-invalid
                @enderror" name="password" id="password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>
                            {{ $message }}
                        </strong>
                    </span>
                @enderror
              </div>
              <button
                class="btn btn-success btn-block w-75 mt-4"
                type="submit">
                Sign In to My Account
              </button>
              <a class="btn btn-signup w-75 mt-2" href="{{ route('register') }}">
                Sign Up
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
