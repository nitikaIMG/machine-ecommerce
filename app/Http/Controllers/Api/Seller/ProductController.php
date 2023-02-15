<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\SellerProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\SellerProduct;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends ApiController
{
    /**
     * Display a listing of Al products
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'shop_id' => ['nullable', 'numeric'],
            'sub_category_id' => ['nullable', 'numeric'],
            'my_products' => ['nullable']
        ]);

        $user = $this->user();

        $shops = $user->user_shops()
            ->with([
                'categories.children',
                'categories.children.parent',
                'categories.shops',
                'sub_categories'
            ])
            ->get();

        $sub_categories = $shops->map->sub_categories->flatten(1);
        $sub_category_ids = [];

        $products = Product::query()
            ->with([
                'product_image'
            ]);

        $selected_shop = null;
        
        if( $sub_category = intval($request->get('sub_category_id')) ) {
            $sub_category = $sub_categories->firstWhere('id', $sub_category);

            if( !$sub_category ) return abort(404);

            $sub_category_ids = [$sub_category->id];
        }
        else if( $shop = intval($request->get('shop_id')) ) {
            $shop = $shops->firstWhere('id', $shop);

            if( !$shop ) return abort(404);

            $selected_shop = $shop;

            $sub_category_ids = $shop->sub_categories->pluck('id')->toArray();
        }
        else {
            $sub_category_ids = $sub_categories->pluck('id')->toArray();
        }

        $sub_category_ids = \array_filter(\array_unique($sub_category_ids));

        if( !empty($sub_category_ids) ) {
            $products->byCategory($sub_category_ids);
        }

        if( !$selected_shop && ($shop = intval($request->get('shop_id'))) ) {
            if( $shop = $shops->firstWhere('id', $shop) ) {
                $selected_shop = $shop;
            }
        }

        if( $selected_shop ) {
            // eager load seller shop only if shop is passed
            $products->with([
                'seller_product' => function($query) use($user,$selected_shop) {
                    $query->where('seller_products.seller_id', $user->id)
                        ->where('seller_products.shop_id', $selected_shop->id)->where('seller_products.delete_flag',0);
                }
            ]);
        }

        // my own products only
        if( $request->get('my_products_only') == '1' ) {

            // $products->has not working
            $products->whereHas('seller_product', function($query) use($user) {
                $query->where('seller_products.seller_id', $user->id)->where('seller_products.delete_flag',0);
            });
        }

        else if( $request->get('my_products_only') == '0' ) {
            $products->whereDoesntHave('seller_product', function($query) use($user) {
                $query->where('seller_products.seller_id', $user->id)->where('seller_products.delete_flag',0);
            });
        }
	//Change here on 26/10/2022 by Tarachand
        $products = $products->get();
        return ApiResponse::ok(__('Products'), SellerProductResource::collection($products));
    }

    /**
     * Display a listing of My products
     *
     * @return \Illuminate\Http\Response
     */
    public function my_products()
    {
        $products = $this->user()->seller_products()
            ->with(['product'])
            ->paginate(15);

        return ApiResponse::ok(__('Products'), SellerProductResource::collection($products));
    }

    // get all categories belonging to this logged in seller
    public function categories(Request $request)
    {
        $request->validate([
            'shop_id' => ['nullable', 'exists:user_shops,id']
        ]);

        $user = $this->user();

        $shops = $user->user_shops()
            ->with([
                'categories.children',
                'categories.children.parent',
                'categories.shops'
            ])
            ->get();

        $parent_categories = [];

        if( $shop = intval($request->get('shop_id')) ) {
            $shop = $shops->firstWhere('id', $shop);

            if( $shop ) {
                $parent_categories = $shop->categories;
            }
        }

        if( empty($parent_categories) ) {
            $parent_categories = $shops->map->categories->flatten(1);
        }

        $categories = ProductCategoryResource::collection($parent_categories);
        
        return ApiResponse::ok(__('Categories'), $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = $this->user();

        $validated = $request->validate([
            'product_id' => ['bail', 'required', 'integer', 'exists:products,id'],
            'qty' => ['nullable', 'numeric','min:1'],
            'price_type' => ['required', 'in:bid,fixed'],
            'price' => ['required_if:price_type,fixed','numeric','min:1', 'regex:/^\d+(\.\d{1,2})?$/'],
            'shop_id' => ['bail', 'required', 'integer', 'exists:user_shops,id,user_id,'.$seller->id]
        ]);

        $product = $seller->seller_products()->create( $validated );

        return ApiResponse::ok(__('Product added'),  new SellerProductResource($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer']
        ]);

        $sellerProduct = $this->user()
            ->seller_products()->findOrFail($request->get('product_id'));

        return ApiResponse::ok(__('Product'), new SellerProduct($sellerProduct));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $seller = $this->user();

        $validated = $request->validate([
            'product_id' => ['bail', 'required', 'integer'],
            'qty' => ['nullable', 'integer'],
            'price_type' => ['required', 'in:bid,fixed'],
            'price' => ['required_if:price_type,fixed', 'regex:/^\d+(\.\d{1,2})?$/' ],
            'shop_id' => ['bail', 'required', 'integer', 'exists:user_shops,id,user_id,'.$seller->id]
        ]);

        if ($request->price == 0) {
            return json_encode(['status'=> 0, 'message'=>'Price is required']);
        }
        if ($request->qty == 0) {
            return json_encode(['status'=> 0, 'message'=>'Quantity is required']);
        }

        $sellerProduct = $seller->seller_products()->firstWhere('product_id', $validated['product_id']);

        if( empty($sellerProduct) ) {
            return $this->store($request);
        }
	    $validated['delete_flag'] = 0;
        $sellerProduct->fill( collect($validated)->except(['product_id', 'shop_id'])->toArray() );
        $sellerProduct->update();

        return ApiResponse::ok(__('Product updated'), new SellerProductResource($sellerProduct));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $seller = $this->user();

        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'], // product_id
        ]);

        $sellerProduct = $seller->seller_products()
            ->where('product_id', $validated['product_id'])
            ->firstOrFail();

        $this->authorize('delete', $sellerProduct);

        $sellerProduct->delete();

        return ApiResponse::ok(__('Product removed'));
    }

    public function softdelete(Request $request){

        $seller = $this->user();

       $validated = $request->validate([
           'product_id' => ['bail', 'required', 'integer'],
           'shop_id' => ['bail', 'required', 'integer', 'exists:user_shops,id,user_id,'.$seller->id]
        ]);
       $sellerProduct = $seller->seller_products()->where('product_id',$validated['product_id'])->where('shop_id',$validated['shop_id'])->update(['delete_flag'=>1]);
       return ApiResponse::ok(__('Product removed'));
   }
}
