@extends('layouts.dashboard')

@section('title')
Account Settings
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My Account</h2>
            <p class="dashboard-subtitle">
                Update your current profile
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <form action="" id="account">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Your Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="email" class="form-control" id="email"
                                                aria-describedby="emailHelp" name="email" value="{{ auth()->user()->email }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressOne">Address 1</label>
                                            <input type="text" class="form-control" id="addressOne"
                                                aria-describedby="emailHelp" name="address_one"
                                                value="{{ $user->address_one }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="addressTwo">Address 2</label>
                                            <input type="text" class="form-control" id="addressTwo"
                                                aria-describedby="emailHelp" name="address_two" value="{{ $user->address_two }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinces_id">Province</label>
                                            <select name="provinces_id" id="provinces_id" class="form-control"
                                            v-if="provinces" v-model="provinces_id">
                                                {{-- <option value="" disabled selected>Select your option</option> --}}
                                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                            </select>
                                            <select v-else class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencies_id">City</label>
                                            <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id">
                                                <option v-for="city in regencies" :value="city.id">@{{ city.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postalCode">Postal Code</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code"
                                                value="{{ $user->zip_code }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" id="country" name="country"
                                                value="{{ $user->country }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                value="{{ $user->phone_number }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="{{ asset('vendor/vue/vue.min.js') }}"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  var locations = new Vue({
    el: "#account",
    mounted() {
        this.getProvinces();
    },
    data: {
        provinces: null,
        regencies: null,
        provinces_id: null,
        regencies_id: null,
    },
    methods: {
        getProvinces(){
            var self = this;
            axios.get('{{ route('api-provinsi') }}')
            .then((res) => {
                self.provinces = res.data
            })
        },
        getRegencies(){
            var self = this;
            axios.get('{{ url('api/cities') }}/' + self.provinces_id)
            .then((res) => {
                self.regencies = res.data
            })
        }
    },
    watch:{
        provinces_id: function(val, oldVal){
            this.regencies_id = null;
            this.getRegencies();
        }
    }
  });
</script>
@endpush
