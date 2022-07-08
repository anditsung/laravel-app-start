<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Inertia\Inertia;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;

        $this->authorizeResource(Role::class);
    }

    public function index()
    {
        return Inertia::render('Role',[
            'fields' => $this->roleRepository->getFields(),
            'resources' => $this->roleRepository->getAllRoles(),
        ]);
    }
}
