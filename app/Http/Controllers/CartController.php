<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\ResponseService;

class CartController extends Controller
{
    public function store(Product $product)
    {
        auth()->user()->cart()->create([
            "product_id" => $product->id
        ]);
        return ResponseService::success(["message" => "Сувенир добавлен в корзину"], 201);
    }

    public function index()
    {
        return auth()->user()->cart;
    }

    public function delete(Product $product)
    {
        $res = auth()->user()->cart()->where('product_id', $product->id);
        if (!$res->first()) {
            return ResponseService::error("Корзина пуста", 422);
        } else {
            $res->delete();
            return ResponseService::success(["message" => "Сувенир удален из корзины"]);
        }
    }
}
