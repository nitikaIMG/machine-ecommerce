<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title') | {{ config('app.name', 'Graphic Newsplus') }}</title>
      <link rel="resource" type="application/l10n" href="{{URL::asset('pdf/web/locale/locale.properties')}}">
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
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         @section('navbar')
         @include('layouts.partials.vendor.navbar')
         @show
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         @section('sidebar')
         @include('layouts.partials.vendor.main_sidebar')
         @show
         <!-- /.main sidebar -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">
                           @section('pageheading')
                           @show
                        </h1>
                     </div>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
               @yield('content')
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         @section('footer')
         @include('layouts.partials.vendor.footer')
         @show
         @section('footer_sidebar')
         @include('layouts.partials.vendor.footer_sidebar')
         @show
      </div>
      @include('layouts.script')
      @yield('scripts')
      @include('layouts._js')
   </body>
</html>