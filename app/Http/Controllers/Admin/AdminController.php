<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    protected $userRepository;

    protected $productRepository;

    protected $roleRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function index(FieldRequest $request)
    {
        $this->authorize('view', User::class);
        $user = $this->userRepository->all($request->validated());

        return UserResource::collection($user);

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
