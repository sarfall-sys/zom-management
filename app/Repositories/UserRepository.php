<?php

namespace App\Repositories;
use App\Models\User;
use App\Interfaces\BaseRepository;
use App\Http\Resources\UserResource;
use App\Models\Role;

class UserRepository implements BaseRepository
{
    public function all(array $filters)
    {
        $query = User::query();
        // Search
        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%'.$filters['search'].'%')
                    ->orWhere('description', 'like', '%'.$filters['search'].'%');
            });
        }

        // Sort
        if (! empty($filters['sort'])) {
            $query->orderBy(
                $filters['sort'],
                $filters['order'] ?? 'asc'
            );
        }

        $perPage = $filters['per_page'] ?? 10;

        return $query->paginate($perPage)->appends($filters);

    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return User::create($attributes);

    }
    public function update($id, array $attributes)
    {
        $user = User::findOrFail($id);
        $user->update($attributes);
        return $user->fresh();
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function getRoles()
    {
       $roles = Role::query()->select('id', 'name')->get();

       return response()->json($roles,200);

    }
}
