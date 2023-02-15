<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\ApiController;
use App\Http\Resources\CustomerProductResource;
use App\Models\SellerProduct;
use App\Services\Api\ApiResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    // show products listing based on the shop
    public function list(Request $request)
    {
        $request->validate(['shop' => ['required', 'exists:user_shops,id']]);

        $shop = $request->get('shop');

        $category = intval($request->get('category'));

        $products = SellerProduct::query()
            ->with(['product.product_category'])
            ->where('shop_id', $shop);
            // ->where(function(Builder $query) use($shop) {

            //     // either the product directly belongs to this shop
            //     $query->where('shop_id', $shop)

            //         // or it belongs to all the shops of this product's seller
            //         ->orWhere(function(Builder $query) use($shop) {
            //             $query->whereNull('shop_id')

            //                 // and we check if this seller owns the $shop
            //                 ->whereHas('shops', function(Builder $query) use($shop) {
            //                     $query->where('id', $shop);
            //                 });
            //         });
            // });

        if( $category ) {
            $products->whereRelation('product.product_category', 'id', $category);
        }

        $user = $this->user();

        $products = CustomerProductResource::collection($products->latest()->paginate(15))
            ->map(function($sellerProductResource) use($user) {
                if($sellerProductResource->product->status == 1){            
                    $sellerProductResource->additional([
                        'is_favourite' => $sellerProductResource->resource->isFavForUser($user)
                    ]);
                    return $sellerProductResource;
                }
            });
        
        $products = $products->filter();

        return ApiResponse::ok(__('Products'), $products);
    }

    public function detail(Request $request)
    {
        $request->validate(['product' => ['required', 'exists:seller_products,id']]);

        $product = intval($request->get('product'));

        if( $sellerProduct = SellerProduct::find($product) ) {

            $data = new CustomerProductResource($sellerProduct);

            $product = $sellerProduct->product;

            $product_images = $product->product_images
                ->map(function($image) {
                    return storage_url($image->image);
                });

            $additional_info = $product->additional_info
                ? json_decode($product->additional_info)
                : [];

            $additional_info = collect($additional_info)
                ->filter()
                ->map(function($value, $key) {
                    return [
                        'key' => $key,
                        'value' => $value
                    ];
                });

            $user = $this->user();

            $in_cart = false;

            if( $user && $user->cart ) {
                $in_cart = $user->cart->isSellerProductInCart($sellerProduct);
            }

            $data->additional([
                'addtional_images' => ((count($product_images) > 0)?$product_images:[storage_url($data->product->cover_image)]),
                'description' => $product->description,
                'additional_info' => array_values($additional_info->toArray()),
                'is_favourite' => $user && $sellerProduct->isFavForUser($user),
                'in_cart' => $in_cart
            ]);

            return ApiResponse::ok(__('Product'), $data);
        }

        return ApiResponse::error(__('Product not found'));
    }

    public function favourites()
    {
        $user = $this->user();

        $products = $user->favourite_products()->paginate(15);

        return ApiResponse::ok(__('Products'), CustomerProductResource::collection($products));
    }

    public function add_to_favourite(Request $request)
    {
        if( $product = intval($request->get('product')) ) {
            if( $product = SellerProduct::find($product) ) {

                $removed = $this->user()->favourite_products()->detach($product->id);

                if( empty($removed) ) {
                    $this->user()->favourite_products()->save($product);

                    return ApiResponse::ok(__('Added to favourites'), ['is_favourite' => true]);
                }

                return ApiResponse::ok(__('Removed from favourites'), ['is_favourite' => false]);
            }
        }

        return ApiResponse::error(__('Not found'));
    }
}
