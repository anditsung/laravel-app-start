<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = User::query();
    }

    public function getFields()
    {
        return [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
            ],
            "email" => [
                'label' => 'Email',
                'type' => 'text',
            ],
        ];
    }

    public function getAllUsers($column = "id", $orderDesc = true)
    {
        if ($orderDesc) {
            $this->model->orderBy($column, 'desc');
        }

        return $this->model->get();
    }

    public function getUserById($userId)
    {
        return $this->model->find($userId);
    }

    public function getUserByName($userName)
    {
        return $this->model->where('name', $userName)->get();
    }

    public function getUserByEmail($userEmail)
    {
        return $this->model->where('email', $userEmail)->get();
    }
}
