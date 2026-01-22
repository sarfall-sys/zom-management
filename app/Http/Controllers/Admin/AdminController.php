<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userRepository;

    protected $productRepository;

    protected $roleRepository;

    public function __construct(UserRepository $userRepository, ProductRepository $productRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function index(FieldRequest $request)
    {
        return $this->userRepository->all($request->validated());
    }

    public function show(User $user)
    {
        return $this->userRepository->find($user->id);
    }

    public function create(StoreUserRequest $request)
    {
        return $this->userRepository->create($request->validated());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->userRepository->update($user->id, $request->validated());
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function getRoles()
    {
        return $this->userRepository->getRoles();
    }

}
