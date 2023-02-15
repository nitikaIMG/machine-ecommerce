@extends('web.layouts.main')

@section('content')

    @if(!empty(Session::get('user_data')))
    <!-- Favourites -->
    <section class="favourites">
        <div class="container max-1170">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">Store Favourites</div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="" class="view-all">View all</a>
                </div>
            </div>
            <div class="row">
                @forelse($favshopList as $shop)
                    
                <div class="col-6 col-md-2">
                    <div class="fav-bock">
                        <figure>
                            <img src="{{ $shop['shop_logo'] }}" alt="" class="img-fluid">
                        </figure>
                        <p class="name">{{ $shop['shop_name'] }}</p>
                    </div>
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
                    <div class="title">Categories</div>
                </div>
                <div class="col-md-6 text-end">
                    <a href="" class="view-all">View all</a>
                </div>
            </div>
            <div class="row">
                @forelse ($productCatListing as $cat)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="fav-bock">
                            <figure>
                                @if (Storage::exists($cat['cover_image']))
                                    <img src="{{ $cat['cover_image'] }}" alt="" class="img-fluid">
                                @else
                                    <img src="https://via.placeholder.com/1920x1050.png" alt="" class="img-fluid">
                                @endif
                            </figure>
                            <div class="content">
                                <p class="name">{{ $cat['title'] }}</p>
                                <p class="description">{{ $cat['short_description'] }}</p>
                            </div>
                        </div>
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
                        @forelse ($shopListing as $shop)
                            <li><img src="{{ $shop['shop_logo'] }}" alt="" width="220" height="140"
                                    class="img-fluid"></li>
                        @empty
                            <p>No Shop Listing Added</p>
                        @endforelse
                    </ul>
                </div>
                <div class="col-md-12 text-center">
                    <a href="" class="view-all">View all</a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works  -->
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

    <!-- Popular Location  -->
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
                <div class="col-md-4">
                    <a class="list active">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="col-md-4">
                    <a class="list">Abu al Abyad (15 places) <i class="fa fa-angle-right"></i></a>
                </div>
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
                            <span class="sb-title">Let’s grow your business together</span>
                        </div>
                        <a href="" class="join-now">join Now</a>
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
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Welcome to Up-Shops </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg"></span>
                    <form id="loginwithemail" data-loader="load_login" action="{{ url('/loginEnd') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                    @csrf
                        <div class="form-group">
                            <label class="label">Email / Phone Number</label>
                            <input type="text" class="form-control" name="email_or_phone" required>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="password-wrap">
                                <input type="password" class="form-control" name="password" required>
                                <div class="show-pass">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login">Login</button>
                        </div>
                        <div class="form-group">
                            <a href="" class="forgot" data-bs-toggle="modal"
                                data-bs-target="#forgot-password">Forgot
                                password?</a>
                            <a href="" class="have-account" data-bs-toggle="modal" data-bs-target="#signup">Don’t
                                have an
                                account?</a>
                        </div>
                        <div class="form-group">
                            <button class="register">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create new account Modal -->
    <div class="modal fade custom-modal" id="create-new-account" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Create new account</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg1"></span>
                    <form id="loginwithotp" data-loader="load_login_otp" action="{{ url('/registerloginEnd') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="form-group">
                            <label class="label">User Type</label>
                            <select class="select" name="type" required>
                                <option value="customer">Customer</option>
                                <option value="seller">Seller</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">Email/Phone Number</label>
                            <input type="text" class="form-control" name="email_or_phone" required>
                        </div>
                        <div class="form-group">
                            <button class="login">Send Confirmation Code</button>
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

    <!-- Reset Password Modal -->
    <div class="modal fade custom-modal" id="reset-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">Reset Password?</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form id="loginwithotp1" data-loader="load_login_otp" action="{{ url('api/login_via_otp') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        <div class="form-group">
                            <label class="label">New Password</label>
                            <div class="password-wrap">
                                <input type="text" class="form-control" name="">
                                <div class="show-pass">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Re-Enter New Password</label>
                            <div class="password-wrap">
                                <input type="text" class="form-control">
                                <div class="show-pass">
                                    <i class="fa fa-eye hide"></i>
                                    <i class="fa fa-eye-slash show"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal Step 1 -->
    <div class="modal fade custom-modal" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel"
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
    </div>

    <!-- OTP Modal -->
    <div class="modal fade custom-modal" id="otp" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="m-head">OTP Validation</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span id="apiMsg2"></span>
                    <form id="sendotp" data-loader="load_send_otp" action="{{ url('loginViaOtpEnd') }}"
                        class="form-signin" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="form-group text-center">
                            <label class="label">Enter your OTP here</label>
                            <input type="hidden" name="email_or_phone">
                            <div class="row">
                                <input type="text" class="form-control text-center col mr-2 inp1" name="inp1"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp2" name="inp2"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp3" name="inp3"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp4" name="inp4"
                                    maxlength="1" required>
                                <input type="text" class="form-control text-center col mr-2 inp5" name="inp5"
                                    maxlength="1" required>
                            </div>
                            <a href="" class="have-account">Didn’t you received any code?</a>
                            <a href="" class="have-account underline mt-3">Resend New Code</a>
                            <div class="timer">
                                1:20 sec
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="login">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
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
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.button_' + formLoader).prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.'
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    } else if (xhr.responseJSON.message == 'validation.password') {
                        errorMsg = 'Please enter password';
                    } else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#apiMsg').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {

                    if (data.status) {
                        $('#apiMsg').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();

                        location.href = "{{ url('/dashboard') }}";

                    } else {
                        $('#apiMsg').html(
                            '<p class="failedMsg text-danger"  ><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
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
        $("form#loginwithotp").submit(function(e) {
            e.preventDefault();

            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            localStorage.setItem('email_phone', $("form#loginwithotp").find('input[name="email_or_phone"]').val());
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
                    $('.button_' + formLoader).prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.';
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    } else if (xhr.responseJSON.message == 'validation.type') {
                        errorMsg = 'Please enter password';
                    } else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#apiMsg1').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    if (data.status) {
                        $('#apiMsg1').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();

                        $('#create-new-account').modal('hide');
                        $('#otp').modal('show');
                        $('#apiMsg2').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $("form#sendotp").find('input[name="email_or_phone"]').val(localStorage.getItem(
                            'email_phone'));

                    } else {
                        let errorMsg = 'Something went wrong. Please try again.';
                        if (data.message == 'validation.email_or_phone') {
                            errorMsg = 'Please enter valid email address/ mobile number';
                        } else if (data.message == 'validation.type') {
                            errorMsg = 'Please enter password';
                        } else {
                            errorMsg = data.message;
                        }
                        $('#apiMsg1').html(
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
        $("form#sendotp").submit(function(e) {
            e.preventDefault();
            var formId = $(this).attr('id');
            var formAction = $(this).attr('action');
            var formLoader = $(this).data('loader');
            var formData = new FormData(this);
            var otp = $(".inp1, .inp2, .inp3, .inp4, .inp5").map(function() {
                return this.value;
            }).get().join("");
            formData.append('otp', otp);
            formData.append('email_or_phone', localStorage.getItem('email_phone'));
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
                    $('.button_' + formLoader).prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.';
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    } else if (xhr.responseJSON.message == 'validation.type') {
                        errorMsg = 'Please enter password';
                    } else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#apiMsg2').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {
                    if (data.status) {
                        $('#apiMsg2').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        $('#' + formId)[0].reset();
                        $('#apiMsg2').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        setTimeout(()=>{
                            $('#otp').modal('hide');
                            location.href = "{{ url('/dashboard') }}";
                        },2000);

                    } else {
                        $('#apiMsg2').html(
                            '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
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
        $("form#resetpassword").submit(function(e) {
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
                    $('.' + formLoader).css('display', 'inline-block');
                    $('.button_' + formLoader).prop('disabled', true);
                    $("html, body").animate({
                        scrollTop: 0
                    }, "slow");
                },
                error: function(xhr, textStatus) {
                    let errorMsg = 'Something went wrong. Please try again.'
                    if (xhr.responseJSON.message == 'validation.email_or_phone') {
                        errorMsg = 'Please enter valid email address/ mobile number';
                    } else if (xhr.responseJSON.message == 'validation.password') {
                        errorMsg = 'Please enter password';
                    } else {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('#apiMsg').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {

                    if (!data.error) {
                        $('#apiMsg').html(
                            '<p class="successMsg text-success"  ><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        console.log('#' + formId);
                        $('#' + formId)[0].reset();

                        location.href = "{{ url('/dashboard') }}";

                    } else {
                        $('#apiMsg').html(
                            '<p class="failedMsg text-danger"  ><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
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
    </script>
@endpush
