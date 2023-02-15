<?php

namespace App\Providers;

use App\Models\CartItemBidding;
use App\Models\SellerProduct;
use App\Policies\CartItemBiddingPolicy;
use App\Policies\SellerProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CartItemBidding::class => CartItemBiddingPolicy::class,
        SellerProduct::class => SellerProductPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
