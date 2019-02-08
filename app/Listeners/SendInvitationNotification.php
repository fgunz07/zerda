<?php

namespace App\Listeners;

use App\Events\InviteDeveloper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\InviteDev;
use App\User;

class SendInvitationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  InviteDeveloper  $event
     * @return void
     */
    public function handle(InviteDeveloper $event)
    {
        \Log::info($event);
        $event->invite;
        // $user->notify(new InviteDev($event));
    }
}
