<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('Vendor Registration')}}</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Favicon  -->
      <link href="{{ asset('favicon-mag.png') }}" rel="icon">
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
      <!-- jQuery Datatable Style -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}">
      <link href="{{ asset('assets/frontend/css/toastr.min.css') }}" rel="stylesheet">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/backend/css/custom/admin.css') }}">
      <link href="{{ asset('assets/frontend/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/frontend/css/select2.min.css') }}" rel="stylesheet" />
      @include('layouts._css')
      @yield('styles')
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
</head>


<body>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{__('Add new vendor')}}</h3>
            </div>
            <form id="form" action="{{ url('seller/store') }}" method="post" autocomplete="on" enctype="multipart/form-data">
               @csrf
               <div class="card-body row">
                  <div class="form-group col-6">
                     <label for="name">{{__('Name of the company')}}</label>
                     <input type="text" class=" form-control col-12 @error('name') is-invalid @enderror" placeholder="Name of the company*" value="{{ old('name') }}" name ="name" autocomplete="false">
                     @error('name')
                     <span class="invalid-feedback" id="name_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="license">{{__('Registration/license number')}}</label>
                     <input type="text" class=" form-control col-12 @error('license') is-invalid @enderror" placeholder="License Number*" value="{{ old('license') }}" name ="license" autocomplete="false">
                     @error('license')
                     <span class="invalid-feedback" id="license_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="email">{{__('Email address')}}</label>
                     <input type="text" name ="email"  class=" form-control @error('email') is-invalid @enderror" placeholder="E-mail*" value="{{ old('email') }}" autocomplete="off">
                     @error('email')
                     <span class="invalid-feedback" id="email_sell_err"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="phone">{{__('Phone')}}</label>
                     <input id="telephone_input" type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone') }}" autocomplete="false">
                     @error('phone')
                     <span style="display:block" class="invalid-feedback" id="phone_sell_err" role="alert">
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
                     <label for="category">{{__('Category')}}</label>
                     <select name="parent_id[]"  multiple="multiple" class="select2-multiple form-control @error('parent_id') is-invalid @enderror"  id="select2Multiple">
                        <option value="">{{ __('Please select category') }}</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                     </select>
                     @error('parent_id')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
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
                     <label for="name">{{ __('Upload id') }}</label>
                     <input type="file" class=" form-control col-12 @error('file') is-invalid @enderror" placeholder="Upload ID*" value="{{ old('file') }}" name="file" autocomplete="false">
                     @error('file')
                     <span class="invalid-feedback" id="upload_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Upload shop image') }}</label>
                     <input type="file" class=" form-control col-12 @error('photos') is-invalid @enderror" placeholder="Upload Shop Image*" value="{{ old('photos') }}" name="photos[]" id="photos" multiple autocomplete="false">
                     @error('photos')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours from') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_from') is-invalid @enderror" placeholder="*" value="{{ old('work_hours_from') }}" name="work_hours_from"  autocomplete="false">
                     {{--  @error('work_hours_from')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours to') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_to') is-invalid @enderror" placeholder="*" value="{{ old('work_hours_to') }}" name="work_hours_to"  autocomplete="false">
                     {{-- @error('work_hours_to')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="password">{{ __('Password') }}</label>
                     <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" placeholder="Password*" autocomplete="false">
                     @error('password')
                     <span class="invalid-feedback" id="password_sell_err" role="alert">
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
                     <span class="invalid-feedback" id="password_confirm_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  {{-- end --}}
                  <div class="form-group col-6">
                     <div id="main_div" style="display:none">
                        <p> <strong>{{__('Uploading image:')}}</strong></p>
                     </div>
                     <div class="row" id="preview_img" style="margin-top:40px"></div>
                  </div>
                  <input type="hidden" name="role" value="seller">    
               </div>
               <ul class="nav nav-tabs" id="langTab" role="tablist">
                  @foreach (frontend_languages() as $language)
                  @php
                  $locale = $language['locale'];
                  $title = $language['title'];
                  @endphp
                  <li class="nav-item">
                     <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $locale }}" role="tab"aria-controls="{{ $locale }}"{{ $loop->first ? 'aria-selected="true"' : '' }}>
                     {{ $title }}
                     </a>
                  </li>
                  @endforeach
               </ul>
               <div class="tab-content mt-4" id="langTabContent">
                  @foreach (frontend_languages() as $language)
                  @php
                  $locale = $language['locale'];
                  $direction = $language['direction'];
                  @endphp
                  <div class="tab-pane fade {{$loop->first ? 'show active':''}}" id="tab{{ $locale }}" role="tabpanel"
                     aria-labelledby="profile-tab">
                     <div class="form-group">
                        <label for="overview_{{ $locale }}">{{ __('Overview') }} ({{ $locale }})</label>
                        <input type="text" class="form-control input-title" id="overview_{{ $locale }}"
                           name="{{ $locale }}[overview]" dir="{{$direction}}" value="{{ old($locale.'.overview') }}">
                        @error($locale.'.overview')
                        <span class="invalid-feedback" id="" role="alert" style="display:block">
                        <strong>{{ $message }}</strong>
                        </span>
                        @else
                        <span class="valid-feedback" role="alert">
                        </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="">{{ __('Services') }}
                        ({{ $locale }})</label>
                        <ul class="list-group list-group-flush additional-info-items">
                           <li class="list-group-item additional-info-item">
                              <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                              <div class="row">
                                 {{-- <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                    <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[services][key][]" type="text">
                                 </div> --}}
                                 <div class="col item-value">
                                    <input dir="{{$direction}}" placeholder="Please Enter Services" class="form-control" name="{{ $locale }}[services][value][]" type="text">
                                 </div>   
                              </div>
                           </li>
                        </ul>
                          <a href="javascript:void(0);" class="ai-add-more d-block text-right text-sm mt-1">+{{__('Add')}}</a>
                     </div>
                     {{-- 
                     <div class="form-group">
                        <label for="services_{{ $locale }}">{{ __('Services') }}
                        ({{ $locale }})
                        </label>
                        <input type="text" class="form-control input-services" id="services_{{ $locale }}"
                           name="{{ $locale }}[services]" dir="{{$direction}}" value="{{ old($locale.'.services') }}">
                        <textarea name="{{ $locale }}[services]"
                           id="services_{{ $locale }}" class="form-control input-services"
                           rows="3"  dir="{{$direction}}">{{ old($locale.'.services') }}</textarea>
                        @error($locale.'.services')
                        <span style="display:block" class="invalid-feedback" id="password_confirm_sell_err" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @else
                        <span class="valid-feedback" role="alert">
                        </span>
                        @enderror 
                     </div>
                     --}}
                  </div>
                  @endforeach
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
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>

<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{asset('js/intlTelInput.min.js')}}"></script>
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
<script type="text/javascript">
   $(document).ready(function(){   
   $(".ai-add-more").click(function(e) {
        e.preventDefault();
        var parent = $(this).parent();
        var itemContainer = parent.find(".additional-info-items").first();
        var itemClone = parent.find(".additional-info-item").first().clone();
        itemClone.find("input").val("");

        itemContainer.append(itemClone);
    });

      $(".additional-info-items").on("click", ".ai-remove-item", function(e) {
         e.preventDefault();

         var parent = $(this).parents(".additional-info-items");

         if( parent.children().length < 2 ) return;

         $(this).parent().remove();
      });

      $('#photos').on('change', function(){ 
         const fi = document.getElementById('photos');
         var files = $(this)[0].files;
         if (window.File && window.FileReader && window.FileList && window.Blob)
         {
            $("#preview_img").empty();
            var data = $(this)[0].files; 
            if(fi.files.length){
               $('#main_div').show();
               $.each(data, function(index, file){ 
                  if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type) ){ 
                     var fRead = new FileReader(); 
                     fRead.onload = (function(file){ 
                     return function(e) {
                         var img = $('<img/>').addClass('thumb').attr('src', e.target.result); 
                         $('#preview_img').append(img); 
                     };
                     })(file);
                     fRead.readAsDataURL(file); 
                  }
               });
            }
         }else{
             alert("Your browser doesn't support File API!"); 
         }
      });
   });
</script>
</body>
</html>

