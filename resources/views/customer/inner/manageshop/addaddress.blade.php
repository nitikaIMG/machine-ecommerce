@extends('customer.layouts.main')
@push('custom_css')
@endpush
@section('content')
    <section class="main-wraper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('customer.inner.leftmenu')
                </div>
                <div class="col-md-12 col-lg-9">
                    <section class="center-wraper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card p30" id="myTab">
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="title">Shipping Address</div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('addnewaddress') }}" method="post">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="name" class="label">Enter Your Name:</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="name" class="form-control"
                                                 value="{{ old('name',isset($useraddress['name']) ? $useraddress['name'] : '')  }}">
                                                    @if($errors->has('name'))
                                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="email" class="label">Enter Your Email :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="email" name="email" class="form-control"
                                                value="{{ old('email',isset($useraddress['email']) ? $useraddress['email'] : '')  }}"
                                                >
                                                    @if($errors->has('email'))
                                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="phone" class="label">Enter Your Phone Number :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="number" name="phone" class="form-control"
                                                value="{{ old('phone',isset($useraddress['phone']) ? $useraddress['phone'] : '')  }}"
                                                >
                                                    @if($errors->has('phone'))
                                                    <div style="color:red">{{ $errors->first('phone') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="address_1" class="label">Enter Your Address 1 :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="address_1" class="form-control"
                                                value="{{ old('address_1',isset($useraddress['address_1']) ? $useraddress['address_1'] : '')  }}">
                                                    @if($errors->has('address_1'))
                                                    <div style="color:red">{{ $errors->first('address_1') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="address_2" class="label">Enter Your Address 2 :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="address_2" class="form-control"
                                                value="{{ old('address_2',isset($useraddress['address_2']) ? $useraddress['address_2'] : '')  }}">
                                                    @if($errors->has('address_2'))
                                                    <div style="color:red">{{ $errors->first('address_2') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                       
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="city" class="label"> Enter Your City :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="city" class="form-control"
                                                value="{{ old('city',isset($useraddress['city']) ? $useraddress['city'] : '')  }}">
                                                    @if($errors->has('city'))
                                                    <div style="color:red">{{ $errors->first('city') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="zip" class="label"> Enter Your Pin Code :</label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="number" name="zip" class="form-control"
                                                value="{{ old('zip',isset($useraddress['zip']) ? $useraddress['zip'] : '')  }}">
                                                    @if($errors->has('zip'))
                                                    <div style="color:red">{{ $errors->first('zip') }}</div>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="state" class="label"> Enter Your State : </label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="state" class="form-control"
                                                value="{{ old('state',isset($useraddress['state']) ? $useraddress['state'] : '')  }}">
                                                    @if($errors->has('state'))
                                                    <div style="color:red">{{ $errors->first('state') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="zip" class="label"> Enter Your Country : </label>
                                            </div>
                                            <div class="col-md-9 col-lg-9">
                                                <input type="text" name="country" class="form-control"
                                                value="{{ old('country',isset($useraddress['country']) ? $useraddress['country'] : '')  }}">
                                                    @if($errors->has('country'))
                                                    <div style="color:red">{{ $errors->first('country') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        @if(!isset($useraddress['is_primary']))
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="zip" class="label"> 
                                                    <input type="checkbox" id="is_primary" value="1"  name="is_primary"> Primary Address : </label>
                                            </div>
                                            @if($errors->has('is_primary'))
                                                    <div style="color:red">{{ $errors->first('is_primary') }}</div>
                                                    @endif
                                            <div class="col-md-9 col-lg-9">
                                           
                                                    
                                            </div>
                                        </div>
                                      @endif
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="zip" class="label">Enter Latitudes : </label>
                                            </div>
                                           
                                            <div class="col-md-9 col-lg-9">
                                            <input class="form-control" type="text" name="latitude"
                                            value="{{ old('latitude',isset($useraddress['latitude']) ? $useraddress['latitude'] : '')  }}" >
                                            @if($errors->has('latitude'))
                                                    <div style="color:red">{{ $errors->first('latitude') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3 col-lg-3">
                                                <label for="zip" class="label">Enter Longitude : </label>
                                            </div>
                                           
                                            <div class="col-md-9 col-lg-9">
                                            <input class="form-control" type="text" name="longitude" 
                                            value="{{ old('longitude',isset($useraddress['longitude']) ? $useraddress['longitude'] : '')  }}">
                                            @if($errors->has('longitude'))
                                                    <div style="color:red">{{ $errors->first('longitude') }}</div>
                                                    @endif
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <label for="Submit">
                                                <input type="Submit" value="Add New Address"
                                                    class="btn btn-outline-success  add-address-btn">
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
