@extends('layouts.admin')
@section('title', __('Users'))
@section('pageheading')
{{ __('Users') }}
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css">
<style>
/*   .iti--allow-dropdown {
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
   background-image: url("{{ url('flags@2x.png') }}"); } }*/
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
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
{{-- <script>
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
</script> --}}
<script>
      document.addEventListener("DOMContentLoaded", function() {
          var $ = $ || jQuery;
      
          var $input = $("#telephone_input");
      
          var iti = intlTelInput($input.get(0), {
              initialCountry: "gh"
          });
      
          $input.on("blur", function() {
              $("#telephone_input_real").val(
                  iti.getSelectedCountryData().dialCode + $input.val()
              );
          });
      });
</script>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{ __('Add new') }}</h3>
            </div>
            <form id="form" action="{{ route('admin.users.store') }}" method="post" autocomplete="on">
               @csrf
               <div class="card-body row">
                
                  <div class="form-group col-6">
                     <label for="name">{{ __('Full name') }}</label>
                     <input type="text" class=" form-control col-12 @error('name') is-invalid @enderror" placeholder="Full Name*" value="{{ old('name') }}" name ="name" autocomplete="false">
                     @error('name')
                     <span class="invalid-feedback" id="name_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="email">{{ __('Email address') }}</label>
                     <input type="text" name="email"  class=" form-control @error('email') is-invalid @enderror" placeholder="E-mail*" value="{{ old('email') }}" autocomplete="false">
                     @error('email')
                     <span class="invalid-feedback" id="email_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="phone">{{ __('Phone') }}</label>
                     <input id="telephone_input" type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone') }}" autocomplete="false">
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
                     <label for="country">{{__('Country')}}</label>
                     <select name="country" id="countryId" class="countries  form-control @error('country') is-invalid @enderror">
                        <option value="">{{__('Select country')}}</option>
                     </select>
                     @error('country')
                     <span class="invalid-feedback" id="country_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="state">{{__('State')}}</label>
                     <select name="state" id="stateId" class=" states form-control @error('state') is-invalid @enderror">
                        <option value="">{{__('Select state')}}</option>
                     </select>
                     @error('state')
                     <span class="invalid-feedback" id=state_sell_err role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="city">{{__('City')}}</label>
                     <select name="city" id="cityId" class="cities  form-control @error('city') is-invalid @enderror">
                        <option value="">{{__('Select city')}} </option>
                     </select>
                     @error('city')
                     <span class="invalid-feedback" id="city_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                    <div class="form-group col-6">
                     <label for="address">{{__('Address line1')}}</label>
                     <input type="text" name="address" class=" form-control " autocomplete="false">
                     @error('address')
                     <span class="invalid-feedback" id="address_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="address2">{{__('Address line2')}}</label>
                     <input type="text" name="address2" class=" form-control" autocomplete="false">
                     @error('address2')
                     <span class="invalid-feedback" id="address2_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                  <div class="form-group col-6">
                     <label for="password">{{ __('Password') }}</label>
                     <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" placeholder="Password*" autocomplete="false">
                     @error('password')
                     <span class="invalid-feedback"  id="password_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="password_confirmation">{{ __('Confirm password') }}</label>
                     <input type="password" class=" form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password*" name="password_confirmation" autocomplete="false">
                     @error('password_confirmation')
                     <span class="invalid-feedback" role="alert" id="confirm_password_err">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <input type="hidden" name="role" value="customer">    
               </div>
               {{-- end card --}}
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btn_submit">{{ __('Submit') }}</button>
                  <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-cancel">{{ __('Cancel') }}</a>
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