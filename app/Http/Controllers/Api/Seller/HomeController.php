<?php

namespace App\Http\Controllers\Api\Seller;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\Api\ApiResponse;
use App\Models\OrderNotiifcation;
use App\Models\ChatMessage;
use App\Models\OrderSeller;
use App\Models\ChatChannel;

class HomeController extends ApiController
{
    public function notifications(){
        return ApiResponse::ok(__('Notifications'), getSellerNotificationUserData(),['count' => getNotificationUser()]);   
    }
    public function notificationRead(){

		try{
		$user = $this->user();

        $c=OrderNotiifcation::where('seller_read','1')->where('seller_id',$user->id)->update(['seller_read'=>'0']);
        
        return ApiResponse::ok(__('Notifications Read'));	
        //where('order_id',$id)->
		// return redirect()->route('seller.quotations.index')->withSuccess(__('Quatation Accepted'));;
    	}catch(\Exception $ex){
           return  ApiResponse::error(__('Something went wrong'));	
          }
    }

    public function getMessageOrOrderCount(){

        try{
            $user = $this->user();
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
            $msg_total = ChatMessage::where('user_id',$user->id)->where('status',0)->count();
            $quotation_total = OrderSeller::where('seller_id',$user->id)->where('status','quotation')->count();

            return ApiResponse::ok(__(' Message Or Order Count'),['new_message_count'=>$unread_msg,'new_quotation'=>$quotation_total]);	
            //where('order_id',$id)->
            // return redirect()->route('seller.quotations.index')->withSuccess(__('Quatation Accepted'));;
            }catch(\Exception $ex){
               return  ApiResponse::error(__('Something went wrong'));	
        } 
    }
}
