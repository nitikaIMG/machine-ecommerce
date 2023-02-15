@extends('customer.layouts.main')

@section('content')
<style type="text/css">
   .wrapper-map{
   width: 400px;
   height: 200px;
   margin: 0 auto;
   border: #ccc solid 1px;
   }
   #searchfield{
   width: 100%;
   }
   #lat, #lng{
   width: 48%;
   }
   #lat{
   margin-right: 2%;
   }
   .wrapper-field{
   width: 800px;
   margin: 0 auto 10px;
   }
   #map {
   width: 100%;
   height: 100%;
   }

   .mobile-cart-notifi {
    display:none;
}
div#mb-menu-toshow {
       display:none;
}
</style>

    @if(Auth::user())
    <!-- Favourites -->
    <section class="favourites">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">Store Favourites</div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('favourites') }}" class="view-all">View all</a>
                </div>
            </div>
            <div class="row">
                @forelse(array_slice($favshopList,0,6) as $shop)                    
                <div class="col-6 col-md-2">
		        <a href="{{ route('shopdetails',$shop['id']) }}">
                    <div class="fav-bock">
                        <figure>
                            <img src="{{ $shop['shop_logo'] }}" alt="" class="img-fluid">
                        </figure>
                        <p class="name">{{ $shop['shop_name'] }}</p>
                    </div>
		        </a>
                </div>
                @empty
                    <p>No Shop Added in Favourite List</p>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- Categories -->
    <section class="categorie">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">Shop Categories</div>
                </div>
                <div class="col-md-6 text-end">
                    @if(Auth::user())
                    	<a href="{{ route('categories') }}" class="view-all">View all</a>
                    @else
                        <a href="#" id="non_auth_category" class="view-all">View all</a>
                    @endif
                </div>
            </div>
            <div class="row">
                @forelse (array_slice($productCatListing,0,6) as $cat)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                    @if(!str_contains($cat['cover_image'], 'via.placeholder') || (isset($cat['cover_image'])))
                    <a href="{{ route('categories') }}" class="view-all">
                        <div class="fav-bock">
                            <figure>
                                <img src="{{ $cat['cover_image'] }}" alt="" class="img-fluid"> 
                            </figure>
                            <div class="content">
                                <p class="name">{{ $cat['title'] }}</p>
                                <p class="description">{{ $cat['short_description'] }}</p>
                            </div>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('categories') }}" class="view-all" style="width:100%;">
                        <div class="fav-bock">
                            <figure class="no-image" style="height: 200px;">
                            </figure>
                            <div class="content">
                                <p class="name">{{ $cat['title'] }}</p>
                                <p class="description">{{ $cat['short_description'] }}</p>
                            </div>
                        </div>
                    </a>                        
                    @endif
                    </div>
                @empty
                    <p>No Product Category Added.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- New Partners  -->
    <section class="new-partners">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">New Partners on Up-Shops</h2>
                </div>
                <div class="col-md-12">
                    <ul class="partner-logo">
                        @forelse(array_slice($shopListing,0,15) as $shop)
                            <li>
                                @if(str_contains($shop['shop_logo'], 'via.placeholder'))
                                    <a href="{{ route('shopdetails',$shop['id']) }}" class="view-all">
                                        <img src="{{ $shop['shop_logo'] }}" alt="" width="220" height="140">
                                    </a>
                                @else
                                    <a href="{{ route('shopdetails',$shop['id']) }}" class="view-all no-image">
                                        <div style="width:220px; height:140px"></div>
                                    </a>
                                @endif
                            </li>
                        @empty
                            <p>No Shop Listing Added</p>
                        @endforelse
                    </ul>
                </div>
                <!-- <div class="col-md-12 text-center">
                    <a href="" class="view-all">View all</a>
                </div> -->
            </div>
        </div>
    </section>

    <!-- How it Works  
    <section class="how-works">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="title">How It Works</h3>
                    <p class="sb-title">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="work-block">
                        <figure>
                            <img src="{{ asset('web/images/how-it-work/icon1.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <p class="head">Buy directly from local shops</p>
                            <p class="text">
                                You can purchase products from shops directly through ShopsApp. Products will be delivered
                                by the shops or a person assigned by shop.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-block">
                        <figure>
                            <img src="{{ asset('web/images/how-it-work/icon2.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <p class="head">Buy directly from local shops</p>
                            <p class="text">
                                You can purchase products from shops directly through ShopsApp. Products will be delivered
                                by the shops or a person assigned by shop.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="work-block">
                        <figure>
                            <img src="{{ asset('web/images/how-it-work/icon3.png') }}" alt="" class="img-fluid">
                        </figure>
                        <div class="content">
                            <p class="head">Buy directly from local shops</p>
                            <p class="text">
                                You can purchase products from shops directly through ShopsApp. Products will be delivered
                                by the shops or a person assigned by shop.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     Popular Location  -->
    <section class="popular-location">
        <div class="container max-1170">
            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="title">Popular localities in and around UAE</div>
                </div>
                <div class="col-md-6 text-end">
                    <img src="{{ asset('web/images/location-image.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row">
                
                @forelse($user_shops as $shop)
                
                       <div class="col-md-4 col-sm-6">
                       <form class="d-flex ms-auto serach-wrap" action="{{ route('searchshop') }}" method="GET" id="formsearchshop" >
                            <input id="latshop" type="hidden" name="latshop" value="{{ isset($_GET['latshop']) ? $_GET['latshop'] : $shop->latitude }}">
                            <input id="lngshop" type="hidden" name="lngshop" value="{{ isset($_GET['lngshop']) ? $_GET['lngshop'] : $shop->longitude }}">
                            <button style="width:100%" class="list" type="submit">{{ $shop->address_1 }} <i class="fa fa-angle-right" ></i></button>
                        </form>
                        </div>
                
              @empty
                <p>No Location</p>
              @endforelse
           </div>
        </div>
    </section>

    <!-- Become Partner -->
    <section class="partner">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-12">
                    <div class="partner-flex">
                        <div class="title">
                            Become a Partner
                            <span class="sb-title">Let's grow your business together</span>
                        </div>
                        <button style="border: 0px;" id="join_partner" class="join-now">join Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download App -->
    <section class="app-download">
        <div class="container max-1170">
            <figure class="app-img">
                <img src="{{ asset('web/images/app-img.png') }}" alt="">
            </figure>
            <div class="content">
                <div class="title">Download the App</div>
                <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.
                </p>
                <a href="" class="store-btn"><img src="{{ asset('web/images/playstore-img.png') }}"
                        alt=""></a>
                <a href="" class="store-btn"><img src="{{ asset('web/images/ios-btn.png') }}"
                        alt=""></a>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade custom-modal" id="login" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Welcome to Up-Shops </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg"></span>
                    <form id="loginwithemail" data-loader="load_login" action="{{ url('/loginEnd') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                    <!-- @csrf -->
                        <div class="form-group">
                            <label class="label">Email / Phone Number</label>
                            <input type="text" class="form-control" name="email_or_phone" required>
                            
                            <input id="latshoplog" type="hidden" name="latshoplog">
                            <input id="lngshoplog" type="hidden" name="lngshoplog">

                            <input class="form-control me-2" type="hidden" name="shoptitlelog" id="shoptitlelog">
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="password-wrap">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <div class="show-pass" onclick="myFunction()">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login login_btn">Login</button>
                        </div>
                        <div class="form-group">
                        <a class="nav-link forgotpass-txt" href="#" data-bs-toggle="modal"
                                                data-bs-target="#forgot-password">
                                                Forgot Password ?
                                            </a>
                                            <p class="text-center mt-3">Don't have an account? </p>
                            <a href="" class="have-account" data-bs-toggle="modal" data-bs-target="#create-new-account">Register Now </a>
                        </div>
                        <!-- <div class="form-group">
                            <a type="button" class="register">Register Now</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Reset Password Modal -->
   <div class="modal fade custom-modal" id="forgot-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Forgot Password?</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="forgot_api_msg"></span>
                    <form id="forgot_password_with_otp" data-loader="load_login_otp" action="{{ route('web.forgot_password') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <!-- @csrf -->
                        <div class="form-group">
                            <label class="label">Email/Phone Number</label>
                            <div class="password-wrap">
                                <input type="text"  class="form-control" name="email_or_phone">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login forgot_submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade custom-modal" id="reset-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Reset Password?</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="reset_api_msg"></span>
                    <form id="reset_password_with_otp" data-loader="load_login_otp" action="{{ route('web.forgot_password') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <!-- @csrf -->
                        <div class="form-group">
                            <label class="label">OTP</label>
                            <div class="password-wrap">
                                <input type="text" class="form-control" name="otp">
                                <input type="hidden" class="form-control" id="forgot_email_or_phone" name="email_or_phone">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="label">New Password</label>
                            <div class="password-wrap">
                                <input type="password" class="form-control" name="password" id="password1">
                                <div class="show-pass" onclick="myFunction1()">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Re-Enter New Password</label>
                            <div class="password-wrap">
                                <input type="password" class="form-control" name="password_confirmation" id="password2">
                                <div class="show-pass" onclick="myFunction2()">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login reset_password">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal Step 1 -->
    <!-- <div class="modal fade custom-modal" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Create New Shop Account</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="hd">Personal Details</div>
                    <div class="form-group">
                        <label class="label">Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="label">Email</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="label">Phone</label>
                        <div class="input-group mb-3">
                            <select class="input-group-text" id="basic-addon1">
                                <option value="">+91</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Password</label>
                        <div class="password-wrap">
                            <input type="text" class="form-control">
                            <div class="show-pass">
                                <i class="fa fa-eye hide"></i>
                                <i class="fa fa-eye-slash show"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Re-Enter Password</label>
                        <div class="password-wrap">
                            <input type="text" class="form-control">
                            <div class="show-pass">
                                <i class="fa fa-eye hide"></i>
                                <i class="fa fa-eye-slash show"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="login" data-bs-toggle="modal" data-bs-target="#shop">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div> -->

     <!-- Create new account Modal -->
     <div class="modal fade custom-modal" id="create-new-account" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Create new account</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg1"></span>
                    <form id="signupform" data-loader="load_login_otp" action="{{ route('customer.send_otp_for_login') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <!-- @csrf -->
                        <div class="form-group">
                            <label class="label">User Type</label>
                            <select class="select" name="type" id="create_type" required>
                                <option value="customer">Customer</option>
                                <option value="seller">Seller</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">Email/Phone Number</label>
                            <input type="text" name="email_or_phone" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <button class="login send_code">Send Confirmation Code</button>
                        </div>
                    </form>
                    <div class="form-group">
                        <p>By tapping “Send confirmation code” above, we will send you an SMS to confirm your phone number.
                            On the next screen, you can choose “Resend code” to initiate another SMS or “Send audio code” to
                            initiate a phone call to confirm
                            your phone number. Charges may apply for SMS, phone calls or data usage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- OTP Modal -->
    <div class="modal fade custom-modal" id="otp" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">OTP Validation</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsgOtp"></span>
                    <form id="sendotp" data-loader="load_send_otp" action="{{ route('customer.otp_for_verify') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <!-- @csrf -->
                        <div class="form-group text-center">
                            <label class="label">Enter your OTP here</label>
                            <input type="hidden" name="email_phone" id="email_or_phone_otp">
                            <div class="row">
                                <input type="text" class="form-control text-center col mr-2 inp1" name="inp1"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp2" name="inp2"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp3" name="inp3"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp4" name="inp4"
                                    maxlength="1" required>
                            </div>
                            <p class="mt-3">Didn't you received any code?</p>
                            <a href="#" type="button" id="resend_new_otp" class="underline ">Resend New Code</a><br>
                            <div class="timer">
                            <span id="timer"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login otp_verify">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Create new Personal Info account Modal -->
      <div class="modal fade custom-modal" id="personal_info" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Create new account</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg3"></span>
                    <form id="personalInfo" data-loader="load_login_otp" action="{{ route('customer.update_account_save') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <!-- @csrf -->
                        
                        <div class="form-group">
                            <label class="label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="label">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="label">Phone</label>
                            <div class="input-group mb-3">
                                <select class="input-group-text" id="basic-addon1" name="phone_code">
                                    <option value="+91">+91</option>
                                </select>
                                <input type="tel" name="mobile" id="mobile" class="form-control" placeholder="Mobile" aria-label="Phone"
                                    aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="password-wrap">
                                <input type="password" name="password" class="form-control" id="password3">
                                <div class="show-pass" onclick="myFunction3()">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Re-Enter Password</label>
                            <div class="password-wrap">
                                <input type="password" name="password_confirmation" id="password4" class="form-control">
                                <div class="show-pass" onclick="myFunction4()">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login personal_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


      <!-- Shop Details Modal -->
      <!-- <div class="modal fade custom-modal" id="shop_Details" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Shop Details</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsgOtp"></span>
                    <form id="shopDetails" data-loader="load_send_otp" action="{{ route('seller.shop_create') }}"
                        class="form-signin" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="label">Shop Name</label>
                            <div class="password-wrap">
                                <input type="text" class="form-control" name="shop_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label">Shop Owner</label>
                            <div class="password-wrap">
                                <input type="text" class="form-control" name="shop_owner">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label">Shop Email</label>
                            <div class="password-wrap">
                                <input type="email" class="form-control" name="shop_email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label">Shop Phone Number</label>
                            <div class="password-wrap">
                                <input type="number" class="form-control" name="shop_phone_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">{{ __('Add a Shop Photo (Upto 5)') }}</label>
                            <div class="password-wrap">
                                <input type="file" class="form-control" multiple name="file[]">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">{{ __('Add A Location') }}</label>
                            <div class="password-wrap">
                            <input type="text" class="form-control" id="searchfield" name="searchfield" placeholder="Search" ><br>
                            <input id="lat" type="hidden" name="lat" placeholder="lat" >
                            <input id="lng" type="hidden" name="lng" placeholder="lng" >
                
                            </div>
                            <div class="wrapper-map">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class=" row form-group">
                            <label class="label">{{ __('Working Hours') }}</label>
                            <div class="password-wrap col-12">
                                <input type="time" class="form-control" name="work_hours_from"   value="{{ old('work_hours_from',isset($seller_shops->working_hours_from) ? $seller_shops->working_hours_from : '') }}">
                            </div>
                            <div class="col-12 ">
                                <input type="time" class="form-control" name="work_hours_to"  value="{{ old('work_hours_to',isset($seller_shops->working_hours_to) ? $seller_shops->working_hours_to : '') }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="label">{{ __('Working Days') }}</label>
                        <div class=" password-wrap">
                        
                            <input type="checkbox"   id="allDays" value="All"  ><label for="All"> All</label><br>
                            <input type="checkbox"  name="working_days[]" value="Su" class="days" ><label for="Sunday"> Sunday</label>
                            <input type="checkbox"  name="working_days[]" value="M" class="days" ><label for="Monday"> Monday</label>
                            <input type="checkbox"  name="working_days[]" value="Tu" class="days" ><label for="Tuesday"> Tuesday</label>
                            <input type="checkbox"  name="working_days[]" value="W" class="days" ><label for="Wednesday"> Wednesday</label><br>
                            <input type="checkbox"  name="working_days[]" value="Th" class="days" ><label for="Thursday"> Thursday</label>
                            <input type="checkbox"  name="working_days[]" value="F" class="days" ><label for="Friday"> Friday</label>
                            <input type="checkbox"  name="working_days[]" value="Sa" class="days" ><label for="Saturday"> Saturday</label>
                        </div>
                    </div>

                        <div class="form-group">
                            <button class="login">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
@endsection

@push('custom_js')
<script>
        $("#mb-menu-toshow").click(function(){
  $("aside").css("left", "0");
});
       $("aside .close-menu").click(function(){
  $("aside").css("left", "-230px");
});
    </script>
<script>
    let timerOn = true;

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;

    if(remaining >= 0 && timerOn) {
        setTimeout(function() {
            timer(remaining);
        }, 1000);
        return;
    }

    if(!timerOn) {
        // Do validate stuff here
        return;
    }

    // Do timeout stuff here
    $('#otp').modal('hide');
}

    $("#allDays").change(function(e) {
      e.preventDefault();
     
      if(this.checked) {
          $('.days').attr('checked', true);
      }else{
          $('.days').attr('checked', false);
      }
   });

   function myFunction() {
    var x = document.getElementById("password");
        if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


function myFunction1() {
    var x = document.getElementById("password1");
        if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


function myFunction2() {
    var x = document.getElementById("password2");
        if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}



function myFunction3() {
    var x = document.getElementById("password3");
        if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}


function myFunction4() {
    var x = document.getElementById("password4");
        if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$("input").keyup(function () {
    if (this.value.length == this.maxLength) {
        $(this).next('input').focus();
    }
});
    </script>

    
    <script>

$(document).ready(function(){
    $("#login,#create-new-account,#otp,#personal_info,forgot-password,reset-password").modal({
        show:false,
        backdrop:'static'
    });
});
$("#non_auth_category").click(function(e){
    e.preventDefault();
    $('#login').modal('show');
    $('#apiMsg').html('<p class="failedMsg text-danger"  ><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; Please Login Here.</p>');
});

$("#join_partner").click(function(e){
    e.preventDefault();
    $('#create-new-account').modal('show');
    $('#create_type').val('seller');
});

    $("#resend_new_otp").click(function(e){
        e.preventDefault();
        var create_email_or_phone=$('#email_or_phone_otp').val();
        var type=$('#create_type').val();
        
        $.ajax({
                url: "{{ url('api/login_via_otp') }}?type="+type+"&email_or_phone="+create_email_or_phone,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'post',
                dataType: 'json',
                
                success: function(data) {
                    if (data.status) {
                        $('#apiMsgOtp').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                    } else {
                        $('#apiMsgOtp').html(
                            '<p class="failedMsg text-danger"  ><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
            });
    });
        $("form#loginwithemail").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');

            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#apiMsg').html('');
                    $('.login_btn').css('display', 'inline-block');
                    $('.login_btn').prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                    $('.login_btn').html('<i class="fa fa-spinner fa-spin"></i>Loading');
                },
                
                success: function(data) {
                    
                    if (data.status) {
                        
                            swal({
                                title: "Welcome",
                                text: data.message,
                                icon: "success",
                                button: "Ok",
                            });

                        $('#' + formId)[0].reset();
                        $('#loginwithemail').modal('hide');
                        var searchshpelocation = localStorage.getItem('searchshpelocation');
                            var shoptitle = localStorage.getItem('shoptitle');
                           var lngshop = localStorage.getItem('lngshop');
                           var latshop = localStorage.getItem('latshop');
                           
                            var searchshoplen = $("#shoptitle").val().length;
                            var lngshoplen = $("#lngshop").val().length;
                            var latshoplen = $("#latshop").val().length;
                        if(data.type=='seller'){
                            
                            if(searchshoplen === 0 && lngshoplen === 0 && latshoplen === 0){
                            location.href = "{{ route('seller.dashboard') }}";
                            }else{

                                window.location.href = "{{ url('searchshop')}}?searchshpelocation="+searchshpelocation+"latshop="+latshop+"&lngshop="+lngshop+"&shoptitle="+shoptitle;
                                localStorage.removeItem('shoptitle');
                                localStorage.removeItem('lngshop');
                                localStorage.removeItem('latshop');
                            }
                        }else{
                            
                            if(searchshoplen === 0 && lngshoplen === 0 && latshoplen === 0){

                                location.href = "{{ url('/home') }}";
                            
                            }else{

                                window.location.href = "{{ url('searchshop')}}??searchshpelocation="+searchshpelocation+"latshop="+latshop+"&lngshop="+lngshop+"&shoptitle="+shoptitle;

                                localStorage.removeItem('shoptitle');
                                localStorage.removeItem('lngshop');
                                localStorage.removeItem('latshop');


                            }
                        }
                       
                    } else {
                        swal({
                                title: "Failed",
                                text: data.error,
                                icon: "error",
                                button: "Ok",
                            });
                    }

                    $('.login').prop('disabled', false);
                    $('.login').html('Login');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });
        $("form#signupform").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            //localStorage.setItem('email_or_phone', $("form#sendotp").find('input[name="email_phone"]').val());
            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#apiMsg1').html('');
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.send_code').prop('disabled', true);
                    $('.send_code').html(' <i class="fa fa-spinner fa-spin"></i>Loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                
                success: function(data) {
                    console.log(data);
                   
                    if (data.status) {
                        $('#email_or_phone_otp').val(data.email_phone);
                        // console.log(data.otp);
                        timer(120);
                        $('#apiMsg1').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();

                        $('#create-new-account').modal('hide');
                        $('#otp').modal('show');
                        $('#apiMsg2').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        // $("form#sendotp").find('input[name="email_or_phone"]').val(localStorage.getItem(
                        //     'email_phone'));

                    } else {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (data.message == 'validation.email_or_phone') {
                            errorMsg = 'Please enter valid email address/ mobile number';
                        } else if (data.message == 'validation.type') {
                            errorMsg = 'Please Select Type';
                        } else {
                            errorMsg = data.message;
                        }
                        $('#apiMsg1').html(
                            '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                                errorMsg + '</p>');
                    }

                    $('.send_code').prop('disabled', false);
                    $('.send_code').html('Send Confirmation Code');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });
        $("form#sendotp").submit(function(e) {
            e.preventDefault();
            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            var formData = new FormData(this);
            var otp = $(".inp1, .inp2, .inp3, .inp4").map(function() {
                return this.value;
            }).get().join("");
            formData.append('otp', otp);
           
            formData.append('email_or_phone', $('#email_or_phone_otp').val());
            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: formData,
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#apiMsg2').html('');
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.otp_verify').prop('disabled', true);
                    $('.otp_verify').html('<i class="fa fa-spinner fa-spin"></i>Loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.';
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    } else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#apiMsgOtp').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    if (data.status) {
                        console.log(data.user);
                        $('#email').val(data.user.email);
                        $('#phone_code').val(data.user.phone_code);
                        $('#mobile').val(data.user.phone);
                        $('#apiMsgOtp').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#otp').modal('hide');
                        $('#' + formId)[0].reset();
                        $('#apiMsgOtp').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        setTimeout(()=>{
                        },2000);
                        $('#personal_info').modal('show');
                    } else {
                        $('#apiMsgOtp').html(
                            '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                    }

                    $('.otp_verify').prop('disabled', false);
                    $('.otp_verify').html('Verify');
                    $('.' + formLoader).css('display', 'none');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });
        $("form#personalInfo").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            //localStorage.setItem('email_phone', $("form#loginwithotp").find('input[name="mobile"]').val());
            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#apiMsg3').html('');
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.personal_btn').prop('disabled', true);
                    $('.personal_btn').prop(' <i class="fa fa-spinner fa-spin"></i>Loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.';
                        errorMsg = xhr.responseJSON.message;
                    $('#apiMsg3').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    
                   
                    if (data.status) {
                        console.log(data);
                        $('#apiMsg3').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();
                        $('#personalInfo').modal('hide');
                            if(data.roles =='Seller'){
                                location.href = "{{ url('/seller/shops/create') }}";
                            }else{

                                swal({
                                title: "Welcome",
                                text: data.message,
                                icon: "success",
                                button: "Ok",
                            });
                            
                                location.href = "{{ url('/home') }}";
                            }
                        $('#apiMsg4').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        // $("form#sendotp").find('input[name="email_or_phone"]').val(localStorage.getItem(
                        //     'email_phone'));

                    } else {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (data.message == 'validation.email') {
                            errorMsg = 'Please enter valid email address/ mobile number';
                        } else if (data.message == 'validation.type') {
                            errorMsg = 'Please Select Type';
                        } else {
                            errorMsg = data.message;
                        }
                        $('#apiMsg3').html(
                            '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                                errorMsg + '</p>');
                    }

                    $('.personal_btn').prop('disabled', false);
                    $('.personal_btn').html('Submit');
                    $('.' + formLoader).css('display', 'none');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });

        $("form#shopDetails").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            //localStorage.setItem('email_phone', $("form#loginwithotp").find('input[name="mobile"]').val());
            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#apiMsg3').html('');
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.button_' + formLoader).prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.';
                        errorMsg = xhr.responseJSON.message;
                    $('#apiMsg3').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    if (data.status) {
                        $('#apiMsg3').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();
                         $('#shop_Details').modal('hide');
                        location.href = "{{ url('/seller/dashboard') }}";
                        $('#apiMsg4').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        // $("form#sendotp").find('input[name="email_or_phone"]').val(localStorage.getItem(
                        //     'email_phone'));

                    } else {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (data.message == 'validation.email') {
                            errorMsg = 'Please enter valid email address/ mobile number';
                        } else if (data.message == 'validation.type') {
                            errorMsg = 'Please Select Type';
                        } else {
                            errorMsg = data.message;
                        }
                        $('#apiMsg3').html(
                            '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                                errorMsg + '</p>');
                    }

                    $('.button_' + formLoader).prop('disabled', false);
                    $('.' + formLoader).css('display', 'none');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });

        $("form#forgot_password_with_otp").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');

            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#forgot_api_msg').html('');
                    $('.forgot_submit').css('display', 'inline-block');
                    $('.forgot_submit').prop('disabled', true);
                    $('.forgot_submit').html('<i class="fa fa-spinner fa-spin"></i>Loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.'
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    }else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#forgot_api_msg').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    $('#forgot_api_msg').html('');
                   if (data.status) {
                    $('#forgot_email_or_phone').val(data.email_or_phone);
                       $('#forgot_api_msg').html(
                           '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                           data.message + '</p>');
                       $('#' + formId)[0].reset();

                       $('#forgot-password').modal('hide');
                                      
		     $('#reset-password').modal('show');
                       $('#reset_api_msg').html(
                           '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                           data.message + '</p>');
                       // $("form#sendotp").find('input[name="email_or_phone"]').val(localStorage.getItem(
                       //     'email_phone'));
                       
                   } else {
                       let errorMsg = 'Something went wrong. Please try again.';
                       if (data.message == 'validation.email_or_phone') {
                           errorMsg = 'Please enter valid email address/ mobile number';
                       } else if (data.message == 'validation.type') {
                           errorMsg = 'Please Select Type';
                       } else {
                           errorMsg = data.message;
                       }
                       $('#forgot_api_msg').html(
                           '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                               errorMsg + '</p>');
                   }

                   $('.forgot_submit').prop('disabled', false);
                   
                   $('.forgot_submit').html('Submit');
                   $("html, body").animate({
                       scrollTop: 0
                   }, "slow");
               },
               cache: false,
               contentType: false,
               processData: false,
            });
        });


        $("form#reset_password_with_otp").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');

            $.ajax({
                url: formAction,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: new FormData(this),
                type: 'post',
                dataType: 'json',
                beforeSend: function() {
                    $('#reset_api_msg').html('');
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.reset_password').prop('disabled', true);
                    $('.reset_password').html(' <i class="fa fa-spinner fa-spin"></i>Loading');
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.'
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    }else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#forgot_api_msg').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    // console.log(data);
                    $('#reset_api_msg').html('');
                    
                   if (data.status) {
                    
                       $('#forgot_api_msg').html(
                           '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                           data.message + '</p>');
                       $('#' + formId)[0].reset();

                       $('#reset-password').modal('hide');
                      
                            swal({
                            title: "Success",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                            });
                     

                   } else {
                       let errorMsg = 'Something went wrong. Please try again.';
                       if (data.message == 'validation.email_or_phone') {
                           errorMsg = 'Please enter valid email address/ mobile number';
                       } else if (data.message == 'validation.type') {
                           errorMsg = 'Please Select Type';
                       } else {
                           errorMsg = data.message;
                       }
                       $('#reset_api_msg').html(
                           '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                               errorMsg + '</p>');
                   }

                   $('.reset_password').prop('disabled', false);
                   $('.reset_password').html('Submit');
                   $('.' + formLoader).css('display', 'none');
                   $("html, body").animate({
                       scrollTop: 0
                   }, "slow");
               },
               cache: false,
               contentType: false,
               processData: false,
            });
        });
    </script>
@endpush
