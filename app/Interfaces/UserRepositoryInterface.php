<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getFields();
    public function getAllUsers($column = "id", $orderDesc = true);
    public function getUserById($userId);
    public function getUserByName($userName);
    public function getUserByEmail($userEmail);
}
