@extends('seller.layouts.vendor')
@section('title', 'Accounts')
@section('pageheading')
{{__('Accounts')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-6 col-lg-5">
                     <div class="title">{{__('Accounts')}}</div>
                  </div>
                  <span id="apiMsg"></span>
               </div>
            </div>
            <form id="profileUpdate" action="{{ route('seller.profileUpdate') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Name')}} :</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="name" placeholder="Will Saunders" value="{{ old('name',isset(auth()->user()->name) ? auth()->user()->name : '' ) }}">
                  </div>
                  @error('name')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Email')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" placeholder="willsaunders@gmail.com" name="email" value="{{ old('email',isset(auth()->user()->email) ? auth()->user()->email : '' ) }}">
                  </div>
                  @error('email')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Phone')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="input-group mb-3">
                        <select class="input-group-text" id="basic-addon1">
                           <option value="">+91</option>
                        </select>
                        <input type="text" class="form-control" placeholder="9876 - 543 - 210" aria-label="Username" name="phone" aria-describedby="basic-addon1" value="{{ old('phone',isset(auth()->user()->phone) ? auth()->user()->phone : '' ) }}">
                        @error('phone')
                        <span style="color:red">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <a class="model1" href="javascript:void(0);" class="change-password w-100 mt-3" data-bs-toggle="modal"
                        data-bs-target="#change-password">
                      {{__('Change Password')}}
                     </a>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{__('Profile')}}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="pic-wrap">
                        <figure class="profile-picture">
                           @php
                           $user_profile_pic = auth()->user()->profile_pic;
                           @endphp
                           @if(isset($user_profile_pic))
			   <span id="pro_img">
                           <img src="{{asset("storage/{$user_profile_pic}")}}"  class="img-fluid">
			  </span>
                           @endif
                        </figure>
                        <a href="#" class="change-photo">
                           <div class="upload_img">Change Photo</div>
                        <input type="file" class="form-control"  aria-label="Username" id="profile_pic" name="profile_pic" aria-describedby="basic-addon1">    
                        </a>
                     </div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label"></label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <button  class="save-btn">{{__('Save')}}</button>
                     <a href="" class="cancel-btn2">{{__('Cancel')}}</a>
                  </div>
               </div>
            </form>
            <!-- <div class="row form-group">
               <div class="col-md-6 col-lg-3">
                   <label for="" class="label"></label>
               </div>
               <div class="col-md-6 col-lg-6">
                   <a href="" class="social fa fa-facebook"></a>
                   <a href="" class="social fa fa-linkedin"></a>
                   <a href="" class="social fa fa-instagram"></a>
               </div>
               </div> -->
         </div>
      </div>
   </div>
</section>
<div class="modal fade custom-modal" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <form id="changePassword" data-loader="load_login" action="{{ route('seller.changePassword') }}" class="form-signin"
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
                     <input type="text" class="form-control" name="old_password">
                     <div class="show-pass">
                        <i class="fa fa-eye hide"></i>
                        <i class="fa fa-eye-slash show"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="label">{{__('New Password')}}</label>
                  <div class="password-wrap">
                     <input type="text" class="form-control" name="new_password">
                     <div class="show-pass">
                        <i class="fa fa-eye hide"></i>
                        <i class="fa fa-eye-slash show"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="label">{{__('Re-Enter New Password')}}</label>
                  <div class="password-wrap">
                     <input type="text" class="form-control" name="new_password_confirmation">
                     <div class="show-pass">
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
@push('custom_js')
<script>
   $("form#profileUpdate").submit(function(e) {
       e.preventDefault();
   
       var formId = $(this).attr('id');
       var formAction = $(this).attr('action');
       var formLoader = $(this).data('loader');
   
       $.ajax({
           url: formAction,
           headers : {
               'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
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
   
            console.log(data.user.profile_pic);
           if (data) {
               console.log(data);

		$('#pro_img').html('<img src="https://'+window.location.host+'/storage/'+data.user.profile_pic+'"" style="widh:100px; height:100px;" class="img-fluid">');

               $('#apiMsg').html(
                   '<p class="successMsg text-success"><i class="fa fa-check-circle" aria-hidden="true" ></i>&nbsp; ' +
                   data.message + '</p>');
                   //location.href = "";
   
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
<script>
   $("form#changePassword").submit(function(e) {
       e.preventDefault();
   
       var formId = $(this).attr('id');
       var formAction = $(this).attr('action');
       var formLoader = $(this).data('loader');
   
       $.ajax({
           url: formAction,
           headers : {
               'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
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
                location.href = "{{ url('seller/login') }}";
   
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
@endsection