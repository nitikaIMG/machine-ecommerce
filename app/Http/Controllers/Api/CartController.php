<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;

class CartController extends ApiController
{
    public function index()
    {
        $user = $this->user();

        $cart_items = $user
            ->cart_items()
            ->has('seller_product')
            ->with([
                'seller_product.product',
                'seller_product.shop',
                'seller_product.shops'
            ])
            ->latest()
            ->paginate(15);

        $cart = $user->cart;

        return ApiResponse::ok(__('Cart items'), [
            'items' => CartItemResource::collection($cart_items),
            'cart_items' => $cart ? $cart->total : 0,
            'total_sum' => $cart ? $cart->total_amount : 0,
            'currency' => 'AED',
            'primary_address' => $user ? $user->primary_address : null
        ]);
    }

    public function add_to_cart(Request $request)
    {
        $request->validate(['product' => ['required', 'exists:seller_products,id']]);

        $product = intval($request->get('product'));

        $qty = intval($request->get('quantity'));
        $qty = $qty > 0 ? $qty : 1;

        $user = $this->user();

        $cart_item = $user->cart_items()
            ->firstWhere('seller_product_id', $product);

        if( empty($cart_item) ) {

            $cart_item = new CartItem([
                'seller_product_id' => $product,
                'user_id' => $user->id,
                'cart_id' => $user->cart()->firstOrCreate()->id
            ]);
        }

        $cart_item->qty = $cart_item->qty ? ($cart_item->qty + $qty) : 1;
        $cart_item->save();

        $cart = $user->cart;

        $data['item'] = new CartItemResource($cart_item);

        $data['cart_items'] = intval($cart ? $cart->total : 0);

        $data['currency'] = 'AED';
        $data['total_sum'] = $cart ? $cart->total_amount : '0.00';

        return ApiResponse::ok(__('Item added'), $data);
    }

    public function remove_from_cart(Request $request)
    {
        $request->validate(['product' => ['required', 'exists:seller_products,id']]);

        $product = intval($request->get('product'));

        $qty = intval($request->get('quantity'));
        $qty = ($qty == -1 || $qty > 0) ? $qty : 1;

        $data = [
            'item' => null,
            'cart_items' => 0,
            'total_sum' => '0.00',
            'currency' => 'AED'
        ];

        $user = $this->user();

        $cart_item = $user->cart_items()
            ->firstWhere('seller_product_id', $product);

        if( $cart_item ) {
            
            if( $qty == -1 ) {
                $cart_item->delete();
            }
            else {
                $cart_item->qty = $cart_item->qty - $qty;

                if( $cart_item->qty == 0 ) {
                    $cart_item->delete();
                } else {
                    $cart_item->save();

                    $data['item'] = new CartItemResource($cart_item);
                }
            }

            /** @var CartItem $cart */
            $cart = $user->cart;
    
            if( $cart->items->isEmpty() ) {
                $cart->forceDelete();
            }

            $data['cart_items'] = intval($cart ? $cart->total : 0);
            $data['total_sum'] = $cart ? $cart->total_amount : '0.00';
        }

        return ApiResponse::ok(__('Item removed'), $data);
    }

}
