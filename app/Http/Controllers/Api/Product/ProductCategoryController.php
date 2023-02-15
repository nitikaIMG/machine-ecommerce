<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\ApiController;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use App\Models\UserShop;
use App\Services\Api\ApiResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    public function list(Request $request)
    {
        $categories = ProductCategory::query()
            ->with(['shops']);

        if( $request->has('only_parent') || $request->has('parent_only') ) {
            $categories->parentCategory();
        }
        else {
            $categories->notParentCategory();
        }

        if( $shop = intval($request->get('shop')) ) {
            $shop = UserShop::findOrFail($shop);
            $categories = $shop->sub_categories;

            return ApiResponse::ok(
                __('Prodcut categories'),
                ProductCategoryResource::collection($categories)
            );
        }

        if( $parent_category = intval($request->get('category')) ) {
            $categories->where('parent_id', $parent_category);
        }

        $categories = $categories->get();

        return ApiResponse::ok(
            __('Prodcut categories'),
            ProductCategoryResource::collection($categories)
        );
    }
}
