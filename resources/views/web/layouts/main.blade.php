<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.layouts.meta')
    <title>Machine Enquiry</title>
    @include('web.layouts.css')
</head>

@include('web.layouts.header')

<body>
    @yield('content')
    @include('web.layouts.footer')

    @stack('custom_js')
</body>

</html>
