<?php

namespace App\Http\Controllers;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use Inertia\Inertia;

class PermissionController extends Controller
{
    private PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;

        $this->authorizeResource(Permission::class);
    }

    public function index()
    {
        return Inertia::render('Permission', [
            'fields' => $this->permissionRepository->getFields(),
            'resources' => $this->permissionRepository->getAllPermissions(),
        ]);
    }
}
