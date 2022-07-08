<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getFields();
    public function getAllPermissions($column = "id", $orderDesc = true);
    public function getPermissionById($permissionId);
    public function getPermissionByName($permissionName);
}
