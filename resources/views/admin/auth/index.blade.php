<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{__('Admin Login - Machine')}}</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.min.css') }}">
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <a href="{{ route('admin.index') }}"><b>{{__('Machine')}}</b>{{__('ADMIN')}}</a>
         </div>
         <!-- /.login-logo -->
         <div class="card">
            <div class="card-body login-card-body">
               <div class="text-center">
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
               </div>
               @if (session('stop'))
               <div class="alert alert-danger">
                  {{ session('stop') }}
               </div>
               @endif
               @if (session('done'))
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  {{ session('done') }}
               </div>
               @endif
               <p class="login-box-msg">{{__('Sign in to start your session')}}</p>
               <form action="{{ route('admin.login') }}" method="post">
                  @csrf
                  <div class="input-group mb-3">
                     <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email" value="{{ old('email') }}">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-envelope"></span>
                        </div>
                     </div>
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="input-group mb-3">
                     <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                     <div class="input-group-append">
                        <div class="input-group-text">
                           <span class="fas fa-lock"></span>
                        </div>
                     </div>
                     @error('password')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                     <label class="form-check-label" for="remember_me">{{__('Remember Me')}}</label>
                  </div>
                  <div class="row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">{{__('Sign In')}}</button>
                     </div>
                     <!-- /.col -->
                  </div>
               </form>
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets//js/adminlte.min.js') }}"></script>
      {{-- @include('common.keep_token_alive') --}}
   </body>
</html>