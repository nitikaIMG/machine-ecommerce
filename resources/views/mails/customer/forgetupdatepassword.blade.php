<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{__('Machine Enquiry')}}</title>
    <!-- Font Awesome Icons -->
     <link rel="stylesheet" href="{{ asset('assets/backend/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.7.0/css/OverlayScrollbars.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.min.css') }}">
    
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
  </head>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          {{--<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>--}}
        </li>
      </ul>
      </nav>
    <style>
      input.parsley-success,
      select.parsley-success,
      textarea.parsley-success {
        color: #468847;
        background-color: #DFF0D8;
        border: 1px solid #D6E9C6;
      }

      input.parsley-error,
      select.parsley-error,
      textarea.parsley-error {
        color: #B94A48;
        background-color: #F2DEDE;
        border: 1px solid #EED3D7;
      }

      .parsley-errors-list {
        margin: 2px 0 3px;
        padding: 0;
        list-style-type: none;
        font-size: 0.9em;
        line-height: 0.9em;
        opacity: 0;
        color: #B94A48;

        transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -webkit-transition: all .3s ease-in;
      }

      .parsley-errors-list.filled {
        opacity: 1;
      }
          </style>
    </head>
    <body>
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{Session::get('message')}}
      </div>
      @endif  
      @if(Session::has('error'))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{Session::get('error')}}
      </div>
      @endif 
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      <br/>
      @endif
      <div class="row mt">
        <div class="col-md-12">
          <h2 style="margin: 0px 0px 12px 12px;">{{__('Forgot Password')}}</h2>
        </div>
      </div>
      <div>
        @if($message=Session::get('success'))
        <div class="alert alert-success">
          <str
            ong>
          {{$message}}</strong> 
        </div>
        @endif
      </div>
      <div class="row">
        <!--  DATE PICKERS -->
        <div class="col-lg-12">
          <div class="form-panel" style="margin:10px;">
            <form method="post" id="passwordvalidation" action="{{url('admin/forgetpasswordupdate')}}" data-parsley-validate >
              {{csrf_field()}}
              <div>
                @if($message=Session::get('success'))
                <div class="alert alert-success">
                  <strong>{{$message}}</strong> 
                </div>
                @endif
              </div>
              <input type="hidden" name="password_token" id="password_token" value="{{$tokens}}">
              <input type="hidden" name="email" id="password_token" value="{{$email}}">

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{__('New password')}}</label>
                <div class="col-md-6">
                  <input id="new_password" type="password" class="form-control" name="new_password" data-parsley-minlength="6" autocomplete="current-password" data-parsley-error-message="Password must be more than 5 character" data-parsley-required>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right"> {{__('Confirm password')}}</label>
                <div class="col-md-6">
                  <input id="confirm_password" type="password" class="form-control" name="confirm_password"  data-parsley-minlength="6" autocomplete="current-password" data-parsley-error-message="Password must be the same" data-parsley-equalto="#new_password" data-parsley-required>
                  {{--<input type="hidden" id="user_id" name="user_id" >--}}
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-4"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">
                  {{__('Update password')}}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
     <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.tutorialjinni.com/parsley.js/2.9.2/parsley.js"></script>
    
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets//js/adminlte.min.js') }}"></script>
</body>

</html>