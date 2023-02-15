<?php

namespace App\Listeners;

use App\Events\NewSellerRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\SellerVerify;


class NewSellerRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewSellerRegistered $event)
    {
        //
        try{
        \Mail::to($event->user->email)->send(
            new SellerVerify($event->user)
        );
       }catch(\Exception $e){
        logger(' issue: '.$e->getMessage());
       }
    }
}
