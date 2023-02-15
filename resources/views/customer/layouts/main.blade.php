<!DOCTYPE html>
<html lang="en">

<head>
    @include('customer.layouts.meta')
    <title>Machine Enquiry</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('customer.layouts.css')
</head>
<input type="hidden" value="<?php echo url('/'); ?>/" id="Baseurl" name="Baseurl">
@include('customer.layouts.header')

<body>
    @yield('content')
    @include('customer.layouts.footer')

    @stack('custom_js')
</body>

</html>
