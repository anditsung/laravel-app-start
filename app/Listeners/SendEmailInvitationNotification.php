<?php

namespace App\Listeners;

use App\Events\Invited;

class SendEmailInvitationNotification
{
    /**
     * Handle the event.
     *
     * @param  Invited  $event
     * @return void
     */
    public function handle(Invited $event)
    {
        if ( !$event->invite->hasSentInvitation()) {
            $event->invite->sendEmailInvitationNotification();
        }
    }
}
