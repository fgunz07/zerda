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
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  InviteDeveloper  $event
     * @return void
     */
    public function handle(InviteDeveloper $event, $user)
    {
        \Log::info($event);
        $user->notify(new InviteDev($event));
    }
}
