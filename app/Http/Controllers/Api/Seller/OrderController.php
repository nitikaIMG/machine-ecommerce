<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Resources\CartItemBiddingResource;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\QuotationResource;
use App\Models\CartItemBidding;
use App\Models\OrderSeller;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Order;
use App\Models\UserShop;
use App\Models\OrderNotiifcation;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CustomerProductResource;
use App\Models\CartItem;

class OrderController extends ApiController
{
    public function quotations(Request $request)
    {

        $pagelimit = ($request->get('limit') !=''?$request->get('limit'):'15');
        $quotations = $this->user()
            ->seller_quotations()
            ->latest()
            ->paginate($pagelimit);

        $quoCollect = collect();
        foreach($quotations as $key => $quotation){
            if(CartItemBidding::where('cart_id',$quotation->cart_id)->where('accepted',0)->exists()){
                $quoArray[$key]['order_no'] = $quotation->order_no;
                $quoArray[$key]['date'] = $quotation->created_at->format('d M, Y - h:i A');
                $quoArray[$key]['date_str'] = $quotation->created_at->diffForHumans();
                $quoCollect = $quoCollect->merge($quoArray);
            }
        }
        if(!empty($quoCollect)){
            return ApiResponse::ok(__('Quotations'), $quoCollect->unique('order_no')->values());
        }else{
            return ApiResponse::ok(__('Quotations'), $quoCollect);
        }
    }

    public function quotation_detail(Request $request)
    {
        $seller = $this->user();

        $request->validate([
            'order_no' => ['required', 'max:191']
        ]);

        //$quotation = $this->user()->seller_quotations()
        //    ->where('order_no', $request->get('order_no'))
        //    ->firstOrFail();
	    
        $quotation =Order::where('order_no',$request->get('order_no'))->firstOrFail();

        $items = $quotation
            ->items()
            ->with(['biddings.customer', 'biddings.seller', 'seller'])

            // only fetch items that belong to this user
            ->whereHas('seller', function($query) use($seller) {
                $query->where('users.id', $seller->id);
            })
            ->get();

        $quotation->setRelation('items', $items);

        $items = CartItemResource::collection($items)
            ->map(function(CartItemResource $cartItemResource) {
                $item = $cartItemResource->resource;

                $accepted_bid = $item->biddings->filter->isBidAccepted->first();

                // shop that is selling this item
                $shop = $item->shop;

                $cartItemResource->additional([
                    'shop' => $item->shop ? [
                        'id' => $shop->id,
                        'shop_name' => $shop->shop_name,
                        'shop_email' => $shop->shop_email
                    ] : null,
                    'biddings' => CartItemBiddingResource::collection($item->biddings),
                    'accepted_bid' => $accepted_bid
                        ? new CartItemBiddingResource($accepted_bid)
                        : null
                ]);

                return $cartItemResource;
            });

        $quotation = new QuotationResource($quotation);

        $quotation->additional([
            'items' => $items
        ]);

        return ApiResponse::ok(__('Quotation'), $quotation);
    }

    public function orders(Request $request)
    {
        $request->validate([
            'status' => ['nullable', 'in:pending,confirmed,delivered,cancelled']
        ]);

        $seller = $this->user();
        $pagelimit = ($request->get('limit') !=''?$request->get('limit'):'15');
        $sort =isset($request->sortbydate) ? $request->sortbydate : "DESC";
        $status =isset($request->status) ? $request->status : "confirmed";

        $orders = $seller
            ->seller_orders()
            ->with([
                
                // latest item that belongs to this seller
                'item' => function($query) use($seller) {
                    $query->whereHas('seller', function($query) use($seller) {
                        $query->where('users.id', $seller->id);
                    });
                },
                'item.seller_product'
            ]);

            $orders = $orders->orderBy('updated_at',$sort);
            $orders->withStatus($status);

        $orders = $orders->paginate($pagelimit);

	foreach($orders as $order){

	 $order_seller = OrderSeller::where('order_id',$order->id)->first();
	 $order->seller_name = $order_seller->seller->name;
     $order->customer_name = $order->customer->name;
     $order->status = $order_seller->status;
     $order->date = $order->created_at->format('d M, Y - h:i A');
     $order->date_str = $order->created_at->diffForHumans();
	 $cart_id = $order->cart_id;
         $carts = CartItem::where('cart_id',$cart_id)->get();
           foreach ($carts as $key => $value) {
                $value->title = $value->seller_product->product->title;
                $value->short_description = $value->seller_product->product->short_description;
                $value->price = $value->seller_product->price; 
                $value->currency ='AED';
                $value->price_type = $value->seller_product->price_type;
                $value->image =$value->seller_product->product->cover_image ? storage_url($value->seller_product->product->cover_image) : sample_img(480, 360);
	            $bid=CartItemBidding::where('cart_item_id',$value->id)->first();
	            $bid=CartItemBidding::where('cart_item_id',$value->id)->first();
	            $value->bid=$bid;
	  }
	
	 
	 $order->items = $carts;
        
	}

        return ApiResponse::ok(__('Orders'), $orders);
    }
    
    public function order_detail(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'integer']
        ]);

        $seller = $this->user();

        $order = $seller
            ->seller_orders()
            ->with([
                // items that belong to this seller
                'items' => function($query) use($seller) {
                    $query->whereHas('seller', function($query) use($seller) {
                        $query->where('users.id', $seller->id);
                    });
                },
                'items.seller_product',
                'orders',
		'customer_address'
            ])
            ->findOrFail($request->get('order_id'));

        $items = $order->items;

        $order = new OrderResource($order);

        $items = CartItemResource::collection($items)
        ->map(function(CartItemResource $cartItemResource) {
            $item = $cartItemResource->resource;

            $cartItemResource->additional([
                'biddings' => CartItemBiddingResource::collection($item->biddings),
                'sellerid' =>$item->seller_product->seller_id ?? null,
            ]);

            return $cartItemResource;
        });
    
     $order->additional(['items' => $items]);

        return ApiResponse::ok(__('Order detail'), $order);
    }

    public function accept_reject_bid(Request $request)
    {
        $request->validate([
            'bid_id' => ['required', 'integer'],
            'accepted' => ['required', 'in:-1,1']
        ]);

        $seller = $this->user();

        $bid = $seller->seller_biddings()->findOrFail($request->get('bid_id'));

        if( $bid->actionTaken ) {
            return ApiResponse::forbidden(__('Cannot modify this bid'));
        }

        $accepted = $request->get('accepted');

        DB::beginTransaction();

        try {

            $bid->accepted = $accepted;
            $bid->save();
 	    $OrderSeller =Order::where('cart_id',$bid->cart_id)->first();
            // if all items' bids are accepted by the seller
            // then we convert this seller_order from quotation to order-pending
            if( $accepted == CartItemBidding::ACCEPTED ) {
                $this->convert_to_order($bid);
            }else{
                if(!empty($OrderSeller)){
                    OrderSeller::where('order_id',$OrderSeller->id)->update(['status'=>'rejected']);
                }
            }

            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();

            logger($e->getMessage());
        }
 
        $message = $accepted == CartItemBidding::ACCEPTED
            ? __('Bid accepted')
            : __('Bid rejected');
        $accete_reject = $accepted == CartItemBidding::ACCEPTED
            ? __('accepted')
            : __('rejected');
        $OrderSeller =Order::where('cart_id',$bid->cart_id)->first();  
        $shop = UserShop::find($bid->shop_id);  
            if(!empty($OrderSeller)){

                $orderId = $OrderSeller->id;
                
                $user = $this->user();
     
                OrderNotiifcation::where('order_id',$orderId)->where('seller_id',$user->id)->update(['user_read'=>'1','seller_read'=>'0']);
             }
             $quotation_message = "Your quotation number ".$OrderSeller->order_no." has been ".$accete_reject." by ".$shop->shop_name;
             notificationFirebase($quotation_message, "Quatation ".$accete_reject,$bid->customer_id,"en");
        return ApiResponse::ok($message);
    }

    public function update_order_status(Request $request)
    {
        $request->validate([
            'order_no' => ['required', 'max:191', 'exists:orders,order_no'],
            'status' => ['required', 'in:confirmed,delivered,cancelled']
        ]);

        $order_no = $request->get('order_no');

        $seller = $this->user();

        $order = OrderSeller::query()
            ->where('seller_id', $seller->id)
            ->whereHas('order', function($query) use($order_no) {
                $query->where('order_no', $order_no);
            })
            ->firstOrFail();

        $order->status = $request->get('status');
        $order->update();

        return ApiResponse::ok(__('Order status updated'));
    }

    // convert quotation to order if all bids are accepted by the seller
    private function convert_to_order(CartItemBidding $cartItemBidding)
    {
        $siblings = $cartItemBidding->siblings;

        $ok = true;

        foreach( $siblings as $sibling_bid ) {
            // if no action taken on any bid; break;
            if( $sibling_bid->noActionTaken ) {
                $ok = false;
                break;
            }

            // if there's rejected bid;
            // check if there's an accepted counterpart
            else if( $sibling_bid->isBidRejected ) {
                $counter_bid = $siblings
                    ->where('cart_item_id', $sibling_bid->cart_item_id)
                    ->where('accepted', CartItemBidding::ACCEPTED)
                    ->first();

                if( empty($counter_bid) ) {
                    $ok = false;
                    break;
                }
            }
        }

        // if all set; conver it to an order
        if( $ok ) {

            $order = $cartItemBidding->order;

            if( empty($order) ) {
                throw new \Exception('order not found id - '.$cartItemBidding->id);
            }
            
            // find the seller_order to mark it as order-pending
            // $seller_order = $cartItemBidding->seller_order;
            $seller_order = $cartItemBidding->get_seller_order($order->id);

            if( empty($seller_order) ) {
                throw new \Exception('accept_reject bid - seller order not found id - '.$cartItemBidding->id);
            }

            $seller_order->status = 'pending';
            $seller_order->update();
        }
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return (new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options))->withPath('/user/my_purchases?type=newspaper');
    }

    public function accept_reject_quotation(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'id' => ['required'],
           'accepted' => ['required', 'in:-1,1']
       ]);

       if ($validator->fails()) {
        return $this->validation_error_response($validator);
      }

       $order = Order::where('order_no',$request->id)->first();
       if( $order->actionTaken ) {
        ApiResponse::forbidden(__('Cannot modify this bid'));
        }

        $order_seller = OrderSeller::where('order_id',$order->id)->first();
      
       // dd($order_seller->order_id);
      
       
       $customer = User::where('id',$order->customer_id)->first();

       // dd($order->order_no);
        $cart_id = $order->cart_id;
       
       $accepted = $request->get('accepted');
       DB::beginTransaction();
       try {
                   if( $accepted == CartItemBidding::ACCEPTED ) {
                    $items = CartItem::where('cart_id',$order->cart_id)->get();
                        foreach($items as $item) {
                            $seller_product = $item->seller_product;
                            $seller_product->qty = intval($seller_product->qty) - intval($item->qty);
                            if($seller_product->qty < 0 ) {
                                DB::rollBack();
        
                                $available_qty = $item->qty + $seller_product->qty;
                                $product_title = isset($item->seller_product->product->title) ? $item->seller_product->product->title : '';
				
				 new CustomerProductResource($seller_product);
                                return json_encode(['status'=> 1, 'message'=>'Not enough quantity available for this product '.$product_title]);
                            }
                            $seller_product->save();
                        }
                       $order_seller_status = 'confirmed';
                   }else{
                       $order_seller_status = 'rejected';
                   }
                   if(isset($cart_id)){
                       CartItemBidding::where('cart_id',$cart_id)->update(['accepted'=>$accepted]);
                       OrderSeller::where('id',$order_seller->id)->update(['status'=>$order_seller_status]);
                       Order::where('id',$order->id)->update(['updated_at'=>date('Y-m-d G:i:s')]);
                   }else{
                       if( empty($cart_id) ) {
                           throw new \Exception('Cart not found id');
                       }
                   }
               DB::commit();

           } catch(\Exception $e) {
               DB::rollBack();

               logger($e->getMessage());
           }
           

       $message = $accepted == CartItemBidding::ACCEPTED
           ? __('Bid accepted')
           : __('Bid rejected');

           $accete_reject = $accepted == CartItemBidding::ACCEPTED
           ? __('accepted')
           : __('rejected'); 
           $shop = UserShop::find($order_seller->shop_id);
           if(!empty($order_seller)){

               $orderId = $order_seller->id;
               
               $user = Auth::user();
    
               OrderNotiifcation::where('order_id',$orderId)->where('seller_id',$user->id)->update(['user_read'=>'1','seller_read'=>'0']);
            }
       
       $quotation_message = "Your quotation number ".$order->order_no." has been ".$accete_reject." by ".$shop->shop_name;
       notificationFirebase($quotation_message, "Quatation ".$accete_reject,$customer->id,"en");
       return json_encode(['status'=> 1, 'message'=>$message]);
    }
}
