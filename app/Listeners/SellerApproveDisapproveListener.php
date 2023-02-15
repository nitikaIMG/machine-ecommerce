<?php

namespace App\Listeners;

use App\Events\SellerApproveDisapprove;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class SellerApproveDisapproveListener
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
     * @param  \App\Events\SellerApproveDisapprove  $event
     * @return void
     */
    public function handle(SellerApproveDisapprove $event)
    {
        //
        // dd($event->user->seller_verified);
        if($event->user->seller_verified == 0){
            try{
                Mail::send('mails.seller.disapprove',
                    array(
                        'name' => $event->user->name,
                        'email' => $event->user->email,
                         // 'password' => $user->password,
                       
                    ), function($message) use ($event)
                    {
                       // $message->from("admin@machine.com");
                        $message->to($event->user->email)->subject('Seller Disapprove ');
                });
            }catch(\Exception $e){
                logger('issue: '.$e->getMessage());
            }
        }else{
            try{
                Mail::send('mails.seller.uniquelink',
                    array(
                        'name' => $event->user->name,
                        'email' => $event->user->email,
                        'password' => $event->user->password,
                       
                    ), function($message) use ($event)
                       {
                        // $message->from("admin@machine.com");
                        $message->to($event->user->email)->subject('Seller Approve ');
                    });
            }catch(\Exception $e){
                logger(' issue: '.$e->getMessage());
            }
        }
    }
}
