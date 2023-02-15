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
                                <div class="card p-3" id="myTab">
                                    <div class="header">
                                        <div class="row">
 					@if (session('success'))
                                            <span style="background-color:green;color:white;">{{ session('success') }}</span>
                                        @else
                                            <span style="background-color:red;color:white;">{{ session('error') }}</span>
                                        @endif
                                            <div class="col-md-6 col-lg-5">
                                                <div class="title">Accounts</div>
                                            </div>
                                            


                                        </div>
                                    </div>

                                    <form action="{{ route('updateprofile') }}" method="POST"
                                        enctype="multipart/form-data" class="account-labels mt-2">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-3">
                                                <label for="name" class="label">Name:</label>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Will Saunders" value="{{ $user['name'] }}">
                                                    @if($errors->has('name'))
                                                    <div style="color:red">{{ $errors->first('name') }}</div>
                                                    @endif
                                            </div>
                                        </div>



                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-3">
                                                <label for="email" class="label">Email:</label>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <input type="text" name="email" class="form-control"
                                                    value="{{ $user['email'] }}"placeholder="example@example.com">
                                                    @if($errors->has('email'))
                                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                                    @endif
                                            </div>
                                        </div>



                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-3">
                                                <label for="phone" class="label">Phone:</label>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="input-group mb-3">
                                                    <select name="phone_code" class="input-group-text" id="basic-addon1">
                                                        <option value="{{ $user['phone_code'] }}">{{ $user['phone_code'] }}
                                                        </option>
                                                    </select>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ $user['phone'] }}" placeholder="9876 - 543 - 210"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                       
                                                   
                                                </div>
                                                <a class="model1" href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target="#change-password">
                                                        Change Password
                                                    </a>
                                            </div>
                                            @if($errors->has('phone'))
                                            <div style="color:red">{{ $errors->first('phone') }}</div>
                                             @endif
                                        </div>



                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-3">
                                                <label for="" class="label">Profile:</label>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="pic-wrap">
                                                    <figure class="profile-picture">
                                                         @if (isset($user['profile_pic']))
                                                             <img src="{{ storage_url($user['profile_pic']) }}"
                                                                alt="No Image found" class="img-fluid">
                                                        @else
                                                            <img src="{{ sample_img(200, 200, $user['name'] ?? '') }}"
                                                                alt="Default Image" class="img-fluid">
                                                        @endif
                                                    </figure>
                                                    <a href="#" class="change-photo">
                                                        <div class="upload_img">Change Photo</div>
                                                        <input type="file" name="profile_pic" class="change-photo">
                                                    </a>
                                                    
                                                </div>
                                                @if($errors->has('profile_pic'))
                                            <div style="color:red">{{ $errors->first('profile_pic') }}</div>
                                             @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-md-6 col-lg-3">
                                                <label for="" class="label"></label>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <input type="submit" value="Save" class="save-btn">
                                                <a href="" class="cancel-btn">{{__('Cancel')}}</a>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>

        </div>
        </div>
        </div>
        </div>
        <div class="modal fade custom-modal" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <form id="changePassword" data-loader="load_login" action="{{ route('changePassword') }}" class="form-signin"
      method="post" accept-charset="utf-8">
      @csrf
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body">
               <div class="m-head">{{__('Reset Password?')}}</div>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
               <span id="apiMsg"></span>
               <div class="form-group">
                  <label class="label">{{__('Old Password')}}</label>
                  <div class="password-wrap">
                     <input type="password" id="password" class="form-control" name="old_password">
                     <div class="show-pass" onclick="myFunction()">
                        <i class="fa fa-eye hide"></i>
                        <i class="fa fa-eye-slash show"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="label">{{__('New Password')}}</label>
                  <div class="password-wrap">
                     <input type="password" id="password1" class="form-control" name="new_password">
                     <div class="show-pass" onclick="myFunction1()">
                        <i class="fa fa-eye hide"></i>
                        <i class="fa fa-eye-slash show"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="label">{{__('Re-Enter New Password')}}</label>
                  <div class="password-wrap">
                     <input type="password" id="password2" class="form-control" name="new_password_confirmation">
                     <div class="show-pass" onclick="myFunction2()">
                        <i class="fa fa-eye hide"></i>
                        <i class="fa fa-eye-slash show"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group text-center">
                  <input type="submit" value="Save" class="save-btn">
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
    </section>
@endsection

@push('custom_js')
    <script>

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

        $("form#updateprofile").submit(function(e) {
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
                    errorMsg = xhr.responseJSON.message;
                    $('#apiMsg').html(
                        '<p class="failedMsg text-danger"><i class="fa fa-times-circle" aria-hidden="true" ></i>&nbsp; ' +
                        errorMsg + '</p>');
                    $('.' + formLoader).css('display', 'none');
                    $('.button_' + formLoader).prop('disabled', false);
                },
                success: function(data) {

                    // console.log(data);
                    if (data) {
                        console.log(data);
                        $('#apiMsg').html(
                            '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                            data.message + '</p>');
                        // $(document).on('hidden', '.custom-modal', function() {
                        //     $(this).remove();
                        // });
                        // $('#' + formId)[0].reset();
                        $('#change-password').modal('hide');
                        location.href = "{{ url('/home') }}";

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
