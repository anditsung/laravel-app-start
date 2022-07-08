<?php

namespace App\Events;

use App\Models\Invite;
use Illuminate\Queue\SerializesModels;

class Invited
{
    use SerializesModels;

    public $invite;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }
}
