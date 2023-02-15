{{-- <a href="{{url("api/auth/login?email=$email&password=$password")}}" style="display: block;width: 50%; margin-top: 26px; margin-left: 114px; background: #007bff;color: #fff;text-decoration: none;   font-size: 15px;font-weight: 600; padding: 16px;  text-align: center; text-transform: capitalize;">Unique link</a><br> --}}
{{__('Hi')}} <b>{{$name}}</b><br>
{{__('You are approved by Admin so you can now login with these credentials')}}
<p>{{__('Your Email is :')}} <b>{{$email}}</b></p>
<p>{{__('Your Password is :')}}<b>{{$password}}</b></p>	
