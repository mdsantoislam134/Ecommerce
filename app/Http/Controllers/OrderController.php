<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;

class OrderController extends Controller
{
    
    public function add_order(Request $request)
    {
        $request->validate([
            'productPackage_id' => 'required|exists:product_packages,id',
            'buyer_id' => 'required|exists:users,id',
            'buyer_address' => 'required|string',
            // Add any other validation rules for your order fields
        ]);

        // Create a new order with random order_id
        $order = new Order([
            'order_id' => Str::random(8),
            'productPackage_id' => $request->input('productPackage_id'),
            'buyer_id' => $request->input('buyer_id'),
            'order_status' => "pending",
            'buyer_address' => $request->input('buyer_address'),
        ]);

        // The 'creating' event in the Order model will generate a random order_id before saving
        $order->save();
        return response()->json(['order' => $order], 200);;
    }
}
