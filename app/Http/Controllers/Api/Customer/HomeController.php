<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use App\Http\Resources\BannerResource;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Order;
use App\Repositories\BannerRepository;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use App\Models\OrderNotiifcation;
use App\Models\UserShop;
use App\Models\ChatMessage;
use App\Models\OrderSeller;
use App\Models\ChatChannel;

class HomeController extends ApiController
{

    private $bannerRepo;

    public function __construct()
    {
        parent::__construct();

        $this->bannerRepo = new BannerRepository();
    }

    public function index()
    {
        $user = $this->user();

        // $categories = cache()->remember('homepage_categories', 60*60, function() {
            $categories = ProductCategory::parentCategory()->get()->map(function($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'cover_image' => $category->cover_image
                        ? storage_url($category->cover_image)
                        : sample_img(1600, 1050, 'Product category')
                ];
            });
        // });

        $favourite_shops = $user->favourite_shops()->take(5)->get()
            ->map(function($shop) {
		$shop_image = isset($shop->photos[0]->photo) ? $shop->photos[0]->photo : sample_img(1600, 1050, $this->shop_name ?? '');
                return [
                    'id' => $shop->id,
                    'shop_name' => $shop->shop_name,
                    'shop_image' => $shop_image
                        ? storage_url($shop_image)
                        : sample_img(200, 200, $shop->shop_name ?? 'Awesome Shop')
                ];
            });

        return ApiResponse::ok(__('Homepage'), [
            'banners' => BannerResource::collection($this->bannerRepo->all()),
            'categories' => $categories,
            'favourite_shops' => $favourite_shops,
            'cart_count' => $user ? $user->cart_items()->count() : 0
        ]);
    }

   public function notifications(){
    return ApiResponse::ok(__('Notifications'), getUserNotificationSellerData(),['count'=>getNotificationUser()]);
    }
    public function notificationRead(){
		
		try{
			
		$user = $this->user();

        $c=OrderNotiifcation::where('user_read','1')->where('user_id',$user->id)->update(['user_read'=>null]);
        return ApiResponse::ok(__('Notifications Read'));	
    	}catch(\Exception $ex){
            return  ApiResponse::error(__('Something went wrong'));	
        }
    }

public function getMessageCount(){
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
            
            return ApiResponse::ok(__(' Message Or Order Count'),['new_message_count'=>$unread_msg]);	
            //where('order_id',$id)->
            // return redirect()->route('seller.quotations.index')->withSuccess(__('Quatation Accepted'));;
            }catch(\Exception $ex){
               return  ApiResponse::error(__('Something went wrong'));	
        } 
    }
}
