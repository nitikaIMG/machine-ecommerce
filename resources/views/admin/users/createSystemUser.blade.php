@extends('layouts.admin')
@section('title', __('System users'))
@section('pageheading')
{{ __('System users') }}
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">
<style>
   .iti--allow-dropdown {
   width: 100%;
   margin-bottom: 20px;
   }
   .iti__flag {
   height: 15px;
   box-shadow: 0px 0px 1px 0px #888;
   background-image: url("{{ url('flags.png') }}");
   background-repeat: no-repeat;
   background-color: #DBDBDB;
   background-position: 20px 0; }
   @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
   .iti__flag {
   background-image: url("{{ url('flags@2x.png') }}"); } }
</style>
@endsection
@section('scripts')
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script>
   
   $('#telephone_input').val('+91');
   // var dial code = // how to get dial code.
    $('#submit').on('click', function () {
       alert(  ('#telephone_input').val());
   });
   
   $('#telephone_input').intlTelInput({
           autoHideDialCode: true,
           autoPlaceholder: "ON",
           dropdownContainer: document.body,
           formatOnDisplay: true,
           hiddenInput: "full_number",
           initialCountry: "auto",
           nationalMode: true,
           placeholderNumberType: "MOBILE",
           preferredCountries: ['US'],
           separateDialCode: true
       });
</script>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{__('Add new system user')}}</h3>
            </div>
            <form action="{{ route('admin.users.storesystemuser') }}" method="post" autocomplete="off">
               @csrf
               <div class="card-body row">
                  <div class="form-group col-6">
                     <label for="full_name">{{__('Full name')}} </label>
                     <input type="text" class=" form-control col-12 @error('full_name') is-invalid @enderror" placeholder="Full Name*" value="{{ old('full_name') }}" name ="full_name" autocomplete="false">
                     @error('full_name')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                     {{-- <input type="text" class="form-control" value="{{ $user->name }}" readonly> --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="email">{{__('Email address')}} </label>
                     <input type="text" name ="email"  class=" form-control @error('email') is-invalid @enderror" placeholder="E-mail*" value="{{ old('email') }}" autocomplete="off">
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                     {{-- <input type="email" class="form-control" value="{{ $user->email }}" readonly> --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="phone">{{__('Phone')}} </label>
                     <input id="telephone_input" type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone') }}" autocomplete="on">
                     @error('phone')
                     <span class="invalid-feedback" id="phone_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="password">{{__('Password')}} </label>
                     <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" placeholder="Password*" autocomplete="false">
                     @error('password')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="password_confirmation">{{__('Confirm password')}} </label>
                     <input type="password" class=" form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password*" name="password_confirmation" autocomplete="false">
                     @error('password_confirmation')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="password">{{__('Select role')}}</label>
                     <select name="role" class="form-control">
                        <option value="">{{__('Select system role')}}</option>
                        <option value="admin">{{__('ADMIN')}}</option>
                        {{-- 
                        <option value="reporter">REPORTER</option>
                        --}}
                     </select>
                  </div>
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('Submit')}} </button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
@stop