<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    public function store()
    {
        $cart = auth()->user()->cart()->get();
        foreach ($cart as $item) {
            auth()->user()->order()->product()->create(['order_id' => $item]);
        }

        return response($cart);
    }

    public function index()
    {

    }
}
