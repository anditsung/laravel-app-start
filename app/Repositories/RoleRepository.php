<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = Role::query();
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

    public function getAllRoles($column = "id", $orderDesc = true)
    {
        if ($orderDesc) {
            $this->model->orderBy($column, 'desc');
        }

        return $this->model->get();
    }

    public function getRoleById($roleId)
    {
        return $this->model->findById($roleId);
    }

    public function getRoleByName($roleName)
    {
        return $this->model->findByName($roleName);
    }
}
