<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\User;
use App\Services\ResponseService;

class OrderController extends Controller
{
    public function store()
    {
        $user = auth()->user();
        $cart = $user->cart()->get();
        if (!count($cart))
            return ResponseService::error('Корзина пуста', 403);

        $order = $user->order()->create();

        foreach ($cart as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
            ]);

            $item->delete();
        }

        return ResponseService::success(['order_id' => $order->id, 'message' => 'Заказ успешно оформлен']);
    }

    public function index()
    {
        return response(OrderResource::collection(auth()->user()->order()->get()));
    }
}
