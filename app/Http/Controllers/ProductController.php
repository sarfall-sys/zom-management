<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
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
        $products = $this->productRepository->all($request->all());
        return  ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productRepository->create($request->validated());
        return new ProductResource($product);
    }
    public function show( $id)
    {
        return new ProductResource($this->productRepository->find($id));
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productRepository->update($id, $request->validated());
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $this->authorize('admin-actions');

        $deleted = $this->productRepository->delete($id);
        return new ProductResource($deleted);
    }
}
