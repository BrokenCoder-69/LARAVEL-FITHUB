<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Store a new order item
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Add the product to the order_items table
        $orderItem = OrderItem::create([
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'price' => $validatedData['price'],
            'order_id' => 1,  // You may need to dynamically get the order ID
        ]);

        if ($orderItem) {
            return response()->json(['success' => true, 'order_item' => $orderItem]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to add to order_items table']);
        }
    }
}
