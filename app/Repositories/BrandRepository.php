<?php

namespace App\Repositories;

use App\Interfaces\BaseRepository;
use App\Models\Brand;
use App\Models\Country;

class BrandRepository implements BaseRepository
{
    public function all(array $filters)
    {
        $query = Brand::query();
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
        return Brand::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Brand::create($attributes);

    }

    public function update($id, array $attributes): Brand
    {
        $brand = Brand::findOrFail($id);

        $brand->update($attributes);

        return $brand->refresh();
    }

    public function delete($id)
    {

        $brand = Brand::findOrFail($id);

        return $brand->delete();
    }

    public function getNameBrand()
    {
        $brands = Brand::query()->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($brands, 200);
    }

    public function getCountries()
    {
        $countries = Country::query()->select('id', 'name')->get();

        return response()->json($countries, 200);
    }
}
