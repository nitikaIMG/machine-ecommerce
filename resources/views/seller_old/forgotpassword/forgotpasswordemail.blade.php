<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{__('Forgot Password - Machine')}}</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.min.css') }}">
      <style type="text/css">
         label{ margin-right: 15px; }
         input.parsley-success,
         select.parsley-success,
         textarea.parsley-success {
         /*color: #468847;*/
         /*background-color: #DFF0D8;*/
         /*border: 1px solid #D6E9C6;*/
         }
         input.parsley-error,
         select.parsley-error,
         textarea.parsley-error {
         /*  color: #dc3545;
         background-color: #F2DEDE;
         border: 1px solid #EED3D7;*/
         }
         .parsley-errors-list {
         margin: 2px 0 3px;
         padding: 0;
         list-style-type: none;
         font-size: 0.9em;
         line-height: 0.9em;
         opacity: 0;
         color: #dc3545;
         transition: all .3s ease-in;
         -o-transition: all .3s ease-in;
         -moz-transition: all .3s ease-in;
         -webkit-transition: all .3s ease-in;
         }
         .parsley-errors-list.filled {
         opacity: 1;
         }
         body {
         font-family: "Nunito", Arial, Helvetica, sans-serif;
         }
      </style>
   </head>
   <body class="hold-transition login-page">
      <div class="login-box">
         <div class="login-logo">
            <a href="{{ route('seller.index') }}">{{__('Machine Enquiry SELLER')}}</a>
         </div>
         <!-- /.login-logo -->
         <div class="card">
            <div class="card-body login-card-body">
               <div class="text-center">
                  {{--  @if (session('success'))
                  <em class="badge badge-success">{{ session('success') }}</em>
                  @else
                  <em class="badge badge-danger">{{ session('error') }}</em>
                  @endif --}}
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
               <!-- <p class="login-box-msg">Sign in to start your session</p> -->
               <form id="form" action="{{route('seller.forgotpassword')}}" method="post"
                  enctype="multipart/form-data" class="form-horizontal style-form"   >
                  @csrf
                  @if($errors->any())
                  <div class="alert alert-danger">
                     <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                     </ul>
                  </div>
                  <br />
                  @endif
                  <div class="card_box">
                    {{-- <input class="form-control"  type="email"  data-parsley-trigger="keyup" parsley-rangelength="[2,50]" name="email" id="email"  data-parsley-required data-parsley-error-message="Please Enter Email Address " placeholder="Email Address"> --}}
                     <input class="form-control"  type="text"   name="forgot_pass" id="forgot_pass"   placeholder="Email Address" value="">
                     <input type="hidden" name="forgot_type" id="forgot_type" value="">
                  </div>
                  <br>
                  <div class="note"></div>
                  <button type="submit" name="submit" value="submit" id="submit"   class="btn  btn-primary">{{__('Submit')}}</button>
               </form>
            </div>
            <!-- /.login-card-body -->
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery -->
      <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
      <script src="https://cdn.tutorialjinni.com/parsley.js/2.9.2/parsley.js"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('assets/backend/js/adminlte.min.js') }}"></script>
      <script type="text/javascript">
        $(document).ready(function(){
             
            $('#forgot_pass').keyup(function() {
              var value = $('#forgot_pass').val();
              //check if number
              if($.isNumeric(value)){
                  $('#forgot_type').val('phone');
              }else{
                 $('#forgot_type').val('email');
         
              }
            });
        });
      </script>
      {{-- @include('common.keep_token_alive') --}}
   </body>
</html>