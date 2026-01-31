<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Role;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        //  $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request)
    {
        $this->authorize('view-any', Product::class);
        $products = $this->productRepository->all($request->all());

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);
        $product = $this->productRepository->create($request->validated());

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        \Log::info('Fetching product', ['id' => $product->id]);
        $product = $this->productRepository->find($product->id);

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', Product::class);
        $product = $this->productRepository->update($product->id, $request->validated());

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $this->authorize('delete', Product::class);

        $deleted = $this->productRepository->delete($id);

        return new ProductResource($deleted);
    }

    public function getRoles()
    {
        $this->authorize('view-any', Product::class);
        $roles = Role::select('id', 'name')->get();

        return response()->json($roles);
    }

    public function getSubfamilies()
    {
        $this->authorize('view-any', Product::class);
        $subfamilies = \App\Models\Subfamily::select('id', 'name')->get();

        return response()->json($subfamilies);
    }
}
