<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{

    public function all(array $filters)
    {
        $query = Product::query();
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

        return Product::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Product::create($attributes);

    }

    public function update($id, array $attributes): Product
    {
        $product = Product::findOrFail($id);
        $product->update($attributes);

        return $product;
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);

        return $product->delete();
    }
}
