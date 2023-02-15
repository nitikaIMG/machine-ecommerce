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
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                  <div class="card-header">{{ __('Please verify code ') }}</div>
                  <div class="card-body">
                     @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                     </div>
                     @endif
                     @if ($message = Session::get('error'))
                     <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                     </div>
                     @endif 
                     <form method="POST" action="{{ route('seller.verify') }}">
                        @csrf
                        <input type="hidden" name="password_token" id="password_token" value="{{$tokens}}">
                        <div class="form-group row">
                           <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('code') }}</label>
                           <div class="col-md-6">
                              <input id="code" type="text" class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" required>
                              @if ($errors->has('code'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('otp') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                        <div class="form-group row mb-0">
                           <div class="col-md-8 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                              {{ __('Verify') }}
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer">
                     {{--  <a href="">Request new code</a>
                     <input type="hidden" name="phone" value="{{request()->phone}}"> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>