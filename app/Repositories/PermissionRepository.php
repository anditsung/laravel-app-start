<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = Permission::query();
    }

    public function getFields()
    {
        return [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
            ],
            "guard_name" => [
                'label' => 'Guard Name',
                'type' => 'text',
            ],
        ];
    }

    public function getAllPermissions($column = "id", $orderDesc = true)
    {
        if ($orderDesc) {
            $this->model->orderBy($column, 'desc');
        }

        return $this->model->get();
    }

    public function getPermissionById($permissionId)
    {
        return $this->model->findById($permissionId);
    }

    public function getPermissionByName($permissionName)
    {
        return $this->model->findByName($permissionName);
    }
}
