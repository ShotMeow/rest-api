<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ResponseService;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(ProductAddRequest $request)
    {
        $product = Product::create($request->validated());
        return ResponseService::success(['id' => $product->id, 'message' => 'Сувенир добавлен в каталог'], 201);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return ResponseService::success(['message' => 'Сувенир удален из каталога']);
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {
        $product->update($request->validated());
        return response(ProductResource::make($product));
    }
}
