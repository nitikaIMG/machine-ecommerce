<?php

use App\Services\Settings\Facade\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\OrderNotiifcation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\UserShop;
use App\Models\OrderSeller;
use App\Models\ChatChannel;
use App\Models\ChatMessage;
if( ! function_exists('app_settings') ) {
    
    function app_settings($key = NULL, $default = NULL) {
        return Settings::get($key, $default);
    }
}

if( ! function_exists('frontend_languages') ) {

    function frontend_languages($toArray = false) {
        $collection = collect( config('languages.frontend') );
        if( $toArray ) {
            return $collection->pluck('locale')->toArray();
        }
        return $collection;
    }
}

if( ! function_exists('frontend_language') ) {

    function frontend_language($locale) {
        $collection = collect( config('languages.frontend') );
        return $collection->firstWhere('locale', $locale) ?? (object)[];
    }
}

if( ! function_exists('generate_otp') ) {

    function generate_otp() {
        return '1234';
    }
}

if( ! function_exists('storage_url') ) {

    function storage_url($path = '', $visibility = 'public') {

        if( filter_var($path, FILTER_VALIDATE_URL) ) {
            return $path;
        }

        else if( empty($path) ) {
            return null;
        }
        
        return url( Storage::url($path) );
    }
}

if( ! function_exists('sample_img') ) {

    function sample_img(int $width = 200, int $height = 200, $text= '') {
        return "https://via.placeholder.com/{$width}x{$height}.png";
    }
}

if( ! function_exists('model_has_property') ) {

    function model_has_property(Model $model, $key) {
        return array_key_exists($key, $model->getAttributes());
    }
}

if( ! function_exists('price_format') ) {

    function price_format($number) {
        return number_format($number, 2, '.', '');
    }
}

if( ! function_exists('getNotificationSeller') ) {

     function getNotificationSeller() {
        $userId = Auth::user()->id;
        
        $ordersNotifiConut = OrderNotiifcation::where('seller_id',$userId)->where('seller_read',"1")->whereNotIn('user_id',[0])->count();
        
        return $ordersNotifiConut;    
    }
}

if( ! function_exists('getNotificationUser') ) {

     function getNotificationUser() {
        $userId = Auth::user()->id;
        
        $ordersNotifiConut = OrderNotiifcation::where('user_id',$userId)->where('user_read',"1")->count();
        //->whereNotIn('user_id',[0])
        return $ordersNotifiConut;    
    }
}

if( ! function_exists('getSellerNotificationUserData') ) {

     function getSellerNotificationUserData() {

        $userId = Auth::user()->id;
        
        // $ordersNotifiData=[];
        
        $ordersNotifiData = OrderNotiifcation::with('user')->with('orderseller')->where('seller_id',$userId)->orderBy('id','desc')->get();
        //$ordersNotifiData = OrderNotiifcation::with('user')->with('orderseller')->where('seller_id',$userId)->where('seller_read',"1")->get();
        //$ordersNotifiData=$ordersNotifiData->toArray();
       

        $data =[];
        $j=0;
            foreach($ordersNotifiData as $value){
            $value['order']=Order::find($value->orderseller->order_id);
            $status = ucfirst($value->orderseller->status);
            if($status=='confirmed'){
                $msg_status =  'New Order';
            }
            if($status=='quotation'){
                $msg_status =  'New Quatation';
            }
            $data[$j++] = [
                    'title' =>  $status,
                    'body' =>  "You have receive new Quotation from ".$value['user']['name']." and Quotation number is ".$value['order']['order_no'],
                    'status' => isset($value['seller_read']) ? $value['seller_read'] : 0,
                    'created_at' =>  $value['updated_at'],
                 ];
    
            }    
        return $data;    
    }
}


if( ! function_exists('getUserNotificationSellerData') ) {

     function getUserNotificationSellerData() {
        $userId = Auth::user()->id;
        
        $ordersNotifiData = OrderNotiifcation::with('seller')->with('orderseller')->where('user_id',$userId)->orderBy('id','desc')->get();
        //$ordersNotifiData = OrderNotiifcation::with('seller')->with('orderseller')->where('user_id',$userId)->where('user_read',"1")->get();
        //$ordersNotifiData=$ordersNotifiData->toArray();
        //return $ordersNotifiData;  
        $data =[];
        $j=0;
        foreach($ordersNotifiData as  $value){
           $value['order']=Order::find($value['orderseller']['order_id']);
            $stdd = OrderSeller::where('order_id',$value['order_id'])->first();
	if($stdd->status!='quotation'){
            if($stdd->status =='rejected'){
                $accept_reject='rejected';
            }else{
                $accept_reject ='accepted';
            }
        $shop = UserShop::find($value['shop_id']);  
     
         $data[$j++] = [
            'title' => 'Quatation Status',
            'body' =>  "Your quotation number ".$value['order']['order_no']." has been ".$accept_reject." by ".$shop->shop_name,
            'status' => $value['user_read'],
            'created_at' => $value['updated_at'],
            ];
}
      }  

      return $data;   
    }
}

if(! function_exists('notificationFirebase') ){
    function notificationFirebase($message,$title,$user_id,$set_langauge){
        $message.",".$title.",".$user_id.",".$set_langauge;
       $obj_user = User::where('id',$user_id)->first(array('device_token'));
	$user = User::find($user_id);
      	$cart_count = $user
        ->cart_items()
        ->count();
	$channels = ChatChannel::where('user_id', $user->id)
            ->orWhereHas('participants', function($query) use($user) {
                $query->where('chat_participants.user_id', $user->id);
            })
            ->with(['user', 'participants'])
	        ->orderBy('id','DESC')
            ->get();
            $unread_msg=0;
            foreach($channels as $value){
              $unread =  ChatMessage::where('chat_channel_id',$value->id)->where('status',0)->count();
        	$unread_msg = $unread_msg + $unread;
            }
	$rfq_total = OrderSeller::where('seller_id',$user->id)->where('status','quotation')->count();
        if($obj_user)
            {
                  $arr_user = $obj_user->toArray();
                if($arr_user['device_token']!='')
                {
    
                    $gcmid=$arr_user['device_token'];
                    $url = 'https://fcm.googleapis.com/fcm/send';
                    $fields = array (
                    'to' => $gcmid,
                    'notification' => array (
                            "body" => $message,
                            "title" =>ucfirst($title),
                            //"click_action"=>"FCM_PLUGIN_ACTIVITY",
                            "click_action"=>"SetValueToBattery",
                            "sound"=>"default",
                            'icon'=>'notification_icon'
                        ),
                        'data' => array (
                            "body1" => $message,
                            "title1" =>ucfirst($title),
                            "type"=>'member',
                            "id"=>$user_id,
			    "notication_count" =>countUnreadNotification($user_id),
			    "cart_count" => $cart_count,
			    "unread_msg"=>$unread_msg,
			    "rfq_count" => $rfq_total,
                            "icon1" => "myicon",
                            "content_available" => true,
                            "priority" => "high"
    
                         )
                    );
    
                    $fields = json_encode ( $fields );
    

                     $headers = array (
                        'Authorization: key=' . "AAAAviG3MNM:APA91bHjr6ri94F-n_AYp0XK5p31DPfGGo44kD9fh8EopHOe0Rjm2GxC0AgigL5GqmJ5A8zB2eY4zDqkv4bY0R-sP_cAjEAPSvAhpTIn_WdGVLUNaCTloMtiVHj5pdwG2RPwqy0AyEOo",
                        'Content-Type: application/json'
                    );
    
                    $ch = curl_init ();
                    curl_setopt ( $ch, CURLOPT_URL, $url );
                    curl_setopt ( $ch, CURLOPT_POST, true );
                    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
                   return $result = curl_exec ( $ch );
    
                    curl_close ( $ch );
                    return true;
                }
            }
    }
}
function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&key=AIzaSyDMLeWZW0BxtJfflLb2a8Qj1VVUJaaP5jI";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return $dist;
}

if(! function_exists('countCartItem') ){
    function countCartItem(){
 	$user = auth()->user();
       $cart_count = $user
        ->cart_items()
        ->has('seller_product')
        ->with([
            'seller_product.product',
            'seller_product.shop',
            'seller_product.shops'
        ])
        ->count();
	return  $cart_count;
    }
}

if(! function_exists('countUnreadNotification') ){
    function countUnreadNotification($id){
$user = User::find($id);
$role =  $user->getRoleStrAttribute();
 	if($role=='Customer'){
           $count = OrderNotiifcation::where('user_id',$user->id)->where('user_read',"1")->count();
            }else{
            $count = OrderNotiifcation::where('seller_id',$user->id)->where('seller_read',"1")->whereNotIn('user_id',[0])->count();            }
	return isset($count) ? $count : 0 ;
    }
}


if(! function_exists('webMsgUserCount') ){
    function webMsgUserCount(){
	$user = auth()->user();
    		$channels = ChatChannel::where('user_id', $user->id)
            ->orWhereHas('participants', function($query) use($user) {
                $query->where('chat_participants.user_id', $user->id);
            })
            ->with(['user', 'participants'])
	        ->orderBy('id','DESC')
            ->get();
            $unread_msg=0;
            foreach($channels as $value){
              $unread =  ChatMessage::where('chat_channel_id',$value->id)->where('user_id','!=',$user->id)->where('status',0)->count();
        	$unread_msg = $unread_msg + $unread;
            }
	return $unread_msg;
    }
}

