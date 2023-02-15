<?php

namespace App\Policies;

use App\Models\CartItemBidding;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartItemBiddingPolicy
{
    use HandlesAuthorization;

    public function place_bid(User $user, CartItemBidding $cartItemBidding, ?float $newBidAmount = null)
    {
        if( $cartItemBidding->customer_id === $user->id ) {
            
            if( ! $cartItemBidding->isOpenForBidding || $this->pending_bid_exists($cartItemBidding) ) {
                return $this->deny(__('Not open for a new bid'));
            }

            if( $newBidAmount && $newBidAmount <= floatval($cartItemBidding->bid) ) {
                return $this->deny(__('New bid amount cannot be lower than the last bid amount'));
            }

            return true;
        }

        return false;
    }

    protected function pending_bid_exists(CartItemBidding $cartItemBidding)
    {
        return CartItemBidding::query()
            ->where([
                'cart_item_id' => $cartItemBidding->cart_item_id,
                'customer_id' => $cartItemBidding->customer_id,
                'seller_id' => $cartItemBidding->seller_id
            ])
            ->whereIn('accepted', [0,1])
            ->exists();
    }
}
