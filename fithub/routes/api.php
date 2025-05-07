<?php

use App\Http\Controllers\AppoinmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeminarController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\ComplaintController;

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

// Post Comments Routes
Route::get('/post-comments', [PostCommentController::class, 'index']);  // Get all comments for posts
Route::post('/post-comments', [PostCommentController::class, 'store']);  // Create a new comment

// Checkout and Order Routes
Route::post('/checkout', [OrderController::class, 'placeOrder']);  // Place an order

// Complaints Routes
Route::post('/complaints', [ComplaintController::class, 'store']);  // User creates a new complaint
Route::get('/complaints', [ComplaintController::class, 'index']);  // Admin views all complaints
Route::get('/user/complaints', [ComplaintController::class, 'userComplaints']);  // User views their own complaints
Route::post('/complaints/{id}/resolve', [ComplaintController::class, 'resolve']);  // Admin resolves a complaint

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
        Route::post('/appointments', [AppoinmentController::class, 'book']);  // Book an appointment

        // Seminar routes
        Route::post('/seminar/store', [SeminarController::class, 'book']);  // Book a seminar

        // Get trainers (for appointments)
        Route::get('/trainers', [AppoinmentController::class, 'trainer']);  // Get available trainers
    });

});
