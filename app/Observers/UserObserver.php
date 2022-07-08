<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public static function creating(User $user)
    {
        if (!$user->uuid) {
            $user->uuid = Str::uuid()->toString();
        }
    }
}
