<?php

namespace App\Http\Controllers;

use App\Interfaces\InviteRepositoryInterface;
use App\Models\Invite;
use Inertia\Inertia;

class InviteController extends Controller
{
    private InviteRepositoryInterface $inviteRepository;

    public function __construct(InviteRepositoryInterface $inviteRepository)
    {
        $this->inviteRepository = $inviteRepository;

        $this->authorizeResource(Invite::class);
    }

    public function index()
    {
        return Inertia::render('Invite', [
            'fields' => $this->inviteRepository->getFields(),
            'resources' => $this->inviteRepository->getAllInvites(),
        ]);
    }
}
