<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        try {
            // Get the authenticated user
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'User not authenticated'], 401); // Unauthorized
            }

            // Create the order
            $order = Order::create([
                'user_id' => $user->id,  // Assuming the user is authenticated
                'total_price' => $validatedData['total_price'],
                'status' => 'pending',
                'shipping_name' => $validatedData['shipping_name'],
                'shipping_address' => $validatedData['shipping_address'],
                'shipping_phone' => $validatedData['shipping_phone'],
            ]);

            // Add order items
            foreach ($validatedData['cart'] as $item) {
                // Ensure the product_id and quantity are correct
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Return response after successful order placement
            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id,
                'status' => 'pending',
                'order_details' => $order,
            ]);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error placing order: ' . $e->getMessage());
            
            // Return a general error message
            return response()->json(['message' => 'An error occurred while placing the order. Please try again later.'], 500);
        }
    }

    // Optional: To retrieve orders of a specific user
    public function getUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)->get();
        return response()->json($orders);
    }
}
