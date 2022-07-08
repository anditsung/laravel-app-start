<?php

namespace App\Repositories;

use App\Interfaces\InviteRepositoryInterface;
use App\Models\Invite;

class InviteRepository implements InviteRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = Invite::query();
    }

    public function getFields()
    {
        return [
            'email' => [
                'label' => 'Email',
                'type' => 'text',
            ],
            'token' => [
                'label' => 'Token',
                'type' => 'text',
            ],
            'used_at_formatted' => [
                'label' => 'Used At',
                'type' => 'text',
            ],
            'expired_at_formatted' => [
                'label' => 'Expired At',
                'type' => 'text',
            ],
            'role_id' => [
                'label' => 'Role',
                'type' => 'text',
            ],
            'sent_at_formatted' => [
                'label' => 'Sent',
                'type' => 'status',
            ],
        ];
    }

    public function getAllInvites($column = "id", $orderDesc = true)
    {
        if ($orderDesc) {
            $this->model->orderBy($column, 'desc');
        }

        return $this->model->get();
    }

    public function getInviteById($inviteId)
    {
        return $this->model->find($inviteId);
    }

    public function getInviteByToken($inviteToken)
    {
        return $this->model->where('token', $inviteToken)->get();
    }

    public function getUserByEmail($inviteEmail)
    {
        return $this->model->where('email', $inviteEmail)->get();
    }

    public function isValidInvite($token, $email)
    {
        return $this->model
            ->where('token', $token)
            ->where('email', $email)
            ->whereNull('used_at');
    }
}
