<?php

namespace App\Http\Controllers;

use App\Models\Product;  // Make sure this import is present
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        $products = Product::all();  // Fetch all products from the database
        return response()->json($products);  // Return products as a JSON response
    }

    // Get a specific product by ID
    public function show($id)
    {
        $product = Product::find($id);  // Find the product by ID

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);  // If product not found, return 404
        }

        return response()->json($product);  // Return the product as JSON
    }
}
