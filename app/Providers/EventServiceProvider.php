<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewUserRegistered;
use App\Listeners\NewUserRegisteredListener;
use App\Events\UserActivated;
use App\Listeners\UserActivatedListener;
use App\Events\UserActivatedDeActivated;
use App\Listeners\UserActivatedDeActivatedListener;
use App\Events\SellerApproveDisapprove;
use App\Listeners\SellerApproveDisapproveListener;
use App\Events\NewSellerRegistered;
use App\Listeners\NewSellerRegisteredListener;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VerifySendMail::class => [
            SendMailFired::class,
        ],
        NewUserRegistered::class => [
            NewUserRegisteredListener::class,
        ],
        NewSellerRegistered::class => [
            NewSellerRegisteredListener::class,
        ],
        UserActivated::class => [
            UserActivatedListener::class,
        ],
        UserDeActivated::class => [
            UserDeActivatedListener::class,
        ],
        UserActivatedDeActivated::class => [
            UserActivatedDeActivatedListener::class,
        ],
        SellerApproveDisapprove::class => [
            SellerApproveDisapproveListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
