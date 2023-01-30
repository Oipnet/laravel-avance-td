<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private RoleRepositoryInterface $roleRepository
    ) {
    }

    public function create(): View
    {
        return view('security.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();

        $roleUser = $this->roleRepository->findByCode('ROLE_USER');

        $user = $this->userRepository->create($validatedData, [$roleUser]);

        Auth::login($user);

        return redirect()->route('homepage');
    }
}
