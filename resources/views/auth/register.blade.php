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
            <form class="mt-3" method="post" enctype="multipart/form-data" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <label>Full Name</label>
                <input type="text"
                name="name" id="name"
                class="form-control @error('name') is-invalid
                @enderror" value="{{ old('name') }}"
                required
                autocomplete="name"
                autofocus
                v-model="name">

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>
                    {{ $message }}
                  </strong>
                </span>
                @enderror

              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email"
                name="email" id="email"
                class="form-control @error('email') is-invalid
                @enderror" value="{{ old('email') }}"
                required
                autocomplete="email"
                v-model="email"
                @change="checkEmail()"
                :class="{ 'is_invalid' : this.email_unavailable }"
                >

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
                <input type="password" name="password"
                class="form-control @error('password')
                is-invalid
                @enderror"
                required
                autocomplete="new-password"/>

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>
                    {{ $message }}
                  </strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation')
                is-invalid
                @enderror"
                required
                autocomplete="new-password"
                id="password-confirm"/>
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
                  name="store_name"
                  id="store_name"
                  class="form-control @error('store_name')
                  is-invalid
                  @enderror"
                  required
                  autocomplete="new-store"
                  autofocus
                  v-model="store_name"
                />
                @error('store_name')
                <span class="invalid-feedback" role="alert">
                  <strong>
                    {{ $message }}
                  </strong>
                </span>
                @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Kategori</label>
                <select name="categories_id" id="categories_id" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach ($categories as $item)
                  <option value="{{ $item->id }}">
                    {{ $item->name }}
                  </option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-success btn-block mt-4"
              :disabled="this.email_unavailable">
                Sign Up Now
              </button>
              <a type="button" href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
        },
        data() {
            return{
            name: "Angga Hazza Sett",
            email: "kamujagoan@bwa.id",
            is_store_open: true,
            store_name: "",
            email_unavailable: false
            }
        },
        methods: {
            checkEmail: function(){
                var self = this;
                axios.get("{{ route('api-register-cek') }}", {
                    params: {
                        email: this.email
                    }
                }).then(function(response){
                    // console.log(response);
                    if(response.data == 'Available'){
                        self.$toasted.show(
                            "Email Tersedia",
                            {
                            position: "top-center",
                            className: "rounded",
                            duration: 1000,
                            }
                        );
                        self.email_unavailable = false;
                    }
                    else{
                        self.$toasted.error(
                            "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                            {
                            position: "top-center",
                            className: "rounded",
                            duration: 1000,
                            }
                        );
                        self.email_unavailable = true;
                    }
                })
            }
        },
      });
    </script>
@endpush
