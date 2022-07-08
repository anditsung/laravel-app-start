<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function getFields();
    public function getAllRoles($column = "id", $orderDesc = true);
    public function getRoleById($roleId);
    public function getRoleByName($roleName);
}
