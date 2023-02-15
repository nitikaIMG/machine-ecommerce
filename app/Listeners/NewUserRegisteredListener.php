<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\CustomerVerify;
use App\Mail\Admin;


class NewUserRegisteredListener
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
     * @param  \App\Events\NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        #for verification mail
       try{
        \Mail::to($event->user->email)->send(
            new CustomerVerify($event->user)
        );
       }catch(\Exception $e){
        logger(' issue: '.$e->getMessage());
       }

       # for send mail credentials
       try{
        \Mail::to($event->user->email)->send(
            new Admin($event->user)
        );
        }catch(\Exception $e){
        logger(' issue: '.$e->getMessage());
       }
    }
}
