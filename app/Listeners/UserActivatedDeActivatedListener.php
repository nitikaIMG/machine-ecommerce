<?php

namespace App\Listeners;

use App\Events\UserActivatedDeActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class UserActivatedDeActivatedListener
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
     * @param  \App\Events\UserActivatedDeActivated  $event
     * @return void
     */
    public function handle(UserActivatedDeActivated $event)
    {
        //
        if($event->user->status == "1" || $event->user->status == "0")
        {
            try{
                Mail::send('mails/roles/deactivate', array( 
                    'name' => $event->user->name,
                    'status' => $event->user->status,
                ), function($message) use ($event){ 
                    // $message->from('admin@machine.com'); 
                    $message->to($event->user->email, 'User')->subject("DeActivated Account"); 
                }); 
            } 
            catch(\Exception $e) {
                logger(' issue: '.$e->getMessage());
            }

        }else{
            try{
            Mail::send('mails/roles/activated', array( 
                'name' => $event->user->name,
                'status' => $event->user->status,
            ), function($message) use ($event){ 
                // $message->from('admin@machine.com'); 
                $message->to($event->user->email, 'User')->subject("Activate Account"); 
            }); 
            } 
            catch(\Exception $e) {
                logger(' issue: '.$e->getMessage());
            }
        }
    }
}
