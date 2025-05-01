<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Handle order placement
    public function placeOrder(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'cart' => 'required|array',  // Cart should be an array
            'shipping_name' => 'required|string',
            'shipping_address' => 'required|string',
            'shipping_phone' => 'required|string',
            'total_price' => 'required|numeric',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => auth()->user()->id,  // Assuming the user is authenticated
            'total_price' => $validatedData['total_price'],
            'status' => 'pending',
            'shipping_name' => $validatedData['shipping_name'],
            'shipping_address' => $validatedData['shipping_address'],
            'shipping_phone' => $validatedData['shipping_phone'],
        ]);

        // Add order items
        foreach ($validatedData['cart'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }
}

