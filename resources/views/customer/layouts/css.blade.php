<link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('web/css/machine_enquiry.css') }}">
<link rel="stylesheet" href="{{ asset('web/css/electrical_style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<style>
    .menu-bar .profile-nav .profile-dropdown{
        left: auto;
    }
    .no-image {
         /* background-color:#cccccc; */
          position:relative;
          border: 1px solid #5faced;
          border-radius: 5px;
        }
    .no-image:after {
        width: 91px;
        height: 73px;
        position: absolute;
        content: "";
        top: 6px;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        z-index: 100;
        background: url('{{ asset("web/images/up.png")}}');
        background-repeat: no-repeat;
        background-size: 100%;
    }
</style>