<?php

namespace App\Policies;

use App\Models\SellerProduct;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellerProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SellerProduct  $sellerProduct
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SellerProduct $sellerProduct)
    {
        if( $sellerProduct->seller_id === $user->id ) {

            // TODO: check if there are pending orders for this product; then restrict

            return true;
        }

        return false;
    }
}
