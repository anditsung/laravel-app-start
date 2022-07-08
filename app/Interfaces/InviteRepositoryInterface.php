<?php

namespace App\Interfaces;

interface InviteRepositoryInterface
{
    public function getFields();
    public function getAllInvites($column = "id", $orderDesc = true);
    public function getInviteById($inviteId);
    public function getInviteByToken($inviteToken);
    public function getUserByEmail($inviteEmail);
    public function isValidInvite($token, $email);
}
