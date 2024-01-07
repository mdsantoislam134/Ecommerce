<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderPackage;

class OrderController extends Controller
{
    
    public function add_order(Request $request)
    {
        $request->validate([
            // 'productPackage_id' => 'required|exists:product_packages,id',
           
            // Add any other validation rules for your order fields
        ]);

        
        $seller = $request->input('packages', []);
        $seller_id = $seller[0]['user_id'];
        
        $order = new Order([
            'order_id' => Str::random(8),
            'buyer_id' => $request->user()->id,
            'seller_id' => $seller_id,
            'order_status' => "pending",
            'total_cost' => $request->price,
            'buyer_address' => $request->buyer_address,
        ]);
        $order->save();

        $items = $request->input('packages', []);

if (is_array($items) && !empty($items)) {
   
    foreach ($items as $all) {
        $pack = new OrderPackage;
        $pack->order_id = $order->id;
        $pack->productPackage_id = $all['id'];
        $pack->total_price = $all['package_price'];
        $pack->package_quantity = $all['package_quantity'];
        $pack->save();
        
    }
}

$data = Order::with('productPackages')->find($order->id);



return response()->json(['order' => $data], 200);

    }
}
