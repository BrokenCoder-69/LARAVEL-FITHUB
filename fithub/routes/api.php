<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeminarController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\ComplaintController; // Import the ComplaintController

// Public routes
Route::post('/register', [AuthController::class, 'register']);  // Register
Route::post('/login', [AuthController::class, 'login']);  // Login

// Products Routes
Route::get('/products', [ProductController::class, 'index']);  // Get all products
Route::get('/products/{id}', [ProductController::class, 'show']);  // Get a specific product by ID

// Community Posts Routes
Route::get('/community-posts', [CommunityPostController::class, 'index']);  // Get all posts
Route::get('/community-posts/{id}', [CommunityPostController::class, 'show']);  // Get a specific post by ID
Route::post('/community-posts', [CommunityPostController::class, 'store']);  // Create a new post

// Checkout and Order Routes
Route::post('/checkout', [OrderController::class, 'placeOrder']);  // Place an order

// Order Item Routes
Route::post('/order-items', [OrderItemController::class, 'store']);  // Add an item to the order_items table

// Fetch all complaints
Route::get('complaints', [ComplaintController::class, 'index']);

// Submit a complaint
Route::post('complaints', [ComplaintController::class, 'store']);

// Resolve a complaint
Route::put('complaints/{id}/resolve', [ComplaintController::class, 'resolve']);

// Authenticated routes (Sanctum Authentication)
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);  // Logout

    // Admin routes (AdminMiddleware)
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Admin Dashboard']);
        });
    });

    // Trainer routes (TrainerMiddleware)
    Route::middleware(TrainerMiddleware::class)->group(function () {
        Route::get('/trainer/dashboard', function () {
            return response()->json(['message' => 'Trainer Dashboard']);
        });
    });

    // User-specific routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/dashboard', function () {
            return response()->json(['message' => 'User Dashboard']);
        });

        // Appointment routes
        Route::post('/appointments', [AppointmentController::class, 'book']);  // Book an appointment

        // Seminar routes
        Route::post('/seminar/store', [SeminarController::class, 'book']);  // Book a seminar

        // Get trainers (for appointments)
        Route::get('/trainers', [AppointmentController::class, 'trainer']);  // Get available trainers
    });
});
