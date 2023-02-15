<?php

namespace App\Providers;

use App\Providers\UserDeActivated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserDeActivatedListener
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
     * @param  \App\Providers\UserDeActivated  $event
     * @return void
     */
    public function handle(UserDeActivated $event)
    {
        //
    }
}
