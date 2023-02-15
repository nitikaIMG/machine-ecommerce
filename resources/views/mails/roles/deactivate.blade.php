Hi <b>{{$name}}</b><br>
@if($status == "2")
{{__('Your are Deactivated By admin For 24 hours  and after 24 hours your account has been automatically activated')}}

@elseif($status=="3")
{{__('Your are Deactivated By admin For 48 hours  and after 48 hours your account has been automatically activated')}}
@elseif($status=="0")
{{__('Your Account has been permanently deactivated by admin.')}}
@endif
{{__('Thanks')}}
