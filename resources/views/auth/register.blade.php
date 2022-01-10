@extends('layouts.auth')

@section('title')
Register
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-auth mt-5" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <h2>
              Memulai untuk jual beli <br />
              dengan cara terbaru
            </h2>
            <form class="mt-3">
              <div class="form-group">
                <label>Full Name</label>
                <input
                  type="text"
                  class="form-control is-valid"
                  aria-describedby="nameHelp"
                  v-model="name"
                  autofocus
                />
              </div>
              <div class="form-group">
                <label>Email</label>
                <input
                  type="email"
                  class="form-control is-invalid"
                  aria-describedby="emailHelp"
                  v-model="email"
                />
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" />
              </div>
              <div class="form-group">
                <label>Store</label>
                <p class="text-muted">
                  Apakah anda juga ingin membuka toko?
                </p>
                <div
                  class="custom-control custom-radio custom-control-inline"
                >
                  <input
                    class="custom-control-input"
                    type="radio"
                    name="is_store_open"
                    id="openStoreTrue"
                    v-model="is_store_open"
                    :value="true"
                  />
                  <label class="custom-control-label" for="openStoreTrue"
                    >Iya, boleh</label
                  >
                </div>
                <div
                  class="custom-control custom-radio custom-control-inline"
                >
                  <input
                    class="custom-control-input"
                    type="radio"
                    name="is_store_open"
                    id="openStoreFalse"
                    v-model="is_store_open"
                    :value="false"
                  />
                  <label
                    makasih
                    class="custom-control-label"
                    for="openStoreFalse"
                    >Enggak, makasih</label
                  >
                </div>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Nama Toko</label>
                <input
                  type="text"
                  class="form-control"
                  aria-describedby="storeHelp"
                />
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Kategori</label>
                <select name="category" class="form-control">
                  <option value="" disabled>Select Category</option>
                </select>
              </div>
              <button type="submit" class="btn btn-success btn-block mt-4">
                Sign Up Now
              </button>
              <button type="submit" class="btn btn-signup btn-block mt-2">
                Back to Sign In
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
