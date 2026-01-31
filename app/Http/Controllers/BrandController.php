<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\Country;
use App\Repositories\BrandRepository;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;

        // $this->authorizeResource(Brand::class, 'brand');
    }

    public function index(FieldRequest $request)
    {
        Log::info('Fetching brands', [
            'filters' => $request->all(),
        ]);

        $this->authorize('viewAny', Brand::class);
        $brand = $this->brandRepository->all($request->validated());

        return BrandResource::collection($brand);
    }

    public function store(StoreBrandRequest $request)
    {
        $this->authorize('create', Brand::class);
        $brand = $this->brandRepository->create($request->validated());

        return new BrandResource($brand);
    }

    public function show(Brand $brand)
    {
        $this->authorize('view', $brand);
        $brand = $this->brandRepository->find($brand->id);

        return new BrandResource($brand);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->authorize('update', $brand);
        $updatedBrand = $this->brandRepository->update($brand->id, $request->validated());

        return new BrandResource($updatedBrand);
    }

    public function destroy($id)
    {
        Log::info('Deleting brand', ['brand_id' => $id]);
        $brand = $this->brandRepository->find($id);
        $this->authorize('delete', $brand);
        $deletedBrand = $this->brandRepository->delete($id);
        Log::info('Brand deleted', ['brand_id' => $id]);

        return new BrandResource($deletedBrand);
    }

    public function getBrandNames()
    {
        $this->authorize('viewAny', Brand::class);
        
        $brandNames = $this->brandRepository->getNameBrand();

        return $brandNames;
    }

    public function getCountry()
    {
        $this->authorize('viewAny', Country::class);

        return $this->brandRepository->getCountries();
    }
}
