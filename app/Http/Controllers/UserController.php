<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->authorizeResource(User::class);
    }

    public function index()
    {
        return Inertia::render('User', [
            'fields' => $this->userRepository->getFields(),
            'resources' => $this->userRepository->getAllUsers(),
        ]);
    }

    public function show($id)
    {
        return $this->userRepository->getUserById($id);
        return $this->userRepository->getUserByName('anditsung');
        return $this->userRepository->getUserByEmail('anditsung@gmail.com');
    }
}
