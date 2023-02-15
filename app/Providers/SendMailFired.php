<?php

namespace App\Providers;

use App\Providers\VerifySendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMailFired
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
     * @param  \App\Providers\VerifySendMail  $event
     * @return void
     */
    public function handle(VerifySendMail $event)
    {
        //
    }
}
