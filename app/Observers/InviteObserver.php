<?php

namespace App\Observers;

use App\Models\Invite;
use Illuminate\Support\Str;

class InviteObserver
{
    public function creating(Invite $invite)
    {
        if (! $invite->token) {
            $invite->token = Str::uuid()->toString();
        }
    }
}
