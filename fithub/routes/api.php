<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppoinmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;



// User registration
Route::post('/register', [AuthController::class, 'register']);

// User login
Route::post('/login', [AuthController::class, 'login']);



/*
|--------------------------------------------------------------------------
| Authenticated Routes (Requires Sanctum Authentication)
|--------------------------------------------------------------------------
*/


Route::middleware('auth:sanctum')->group(function () {

    // User logout
    Route::post('/logout', [AuthController::class, 'logout']);
    // Get seminars booked by the logged-in user
    Route::get('/seminars', [UserController::class, 'seminar']);

    
    // Book an appointment (for gym-related service)
    Route::post('/appointments', [AppoinmentController::class, 'book']);
    
    // Book a seminar session
    Route::post('/seminar/store', [SeminarController::class, 'book']);
});


/*
|--------------------------------------------------------------------------
| Trainer Routes (Requires Trainer Role)
|--------------------------------------------------------------------------
*/



Route::middleware('auth:sanctum', TrainerMiddleware::class)->group(function () {

    // Trainer dashboard endpoint
    Route::get('/trainer/dashboard', function () {
        return response()->json(['message' => 'Trainer Dashboard']);
    });

        
    // List all seminars assigned to the trainer
    Route::get('/trainer/seminar/index', [SeminarController::class, 'trainer_index']);
        
    // View specific seminar details
    Route::get('/trainer/seminar/{id}', [SeminarController::class, 'show']);
        
    // Approve a pending seminar
    Route::post('/trainer/seminar/approve/{id}', [SeminarController::class, 'seminar_accept']);

    // List all pending seminar requests for the trainer
    Route::get('/seminar/pending', [TrainerController::class, 'seminar_is_pending']);
});



/*
|--------------------------------------------------------------------------
| Admin Routes (Requires Admin Role)
|--------------------------------------------------------------------------
*/




Route::middleware('auth:sanctum', AdminMiddleware::class)->group(function () {

    // Admin dashboard endpoint
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Admin Dashboard']);
    });

    // Get count of users
    Route::get('/admin/count/user', [AdminController::class, 'user_count']);

    // Get count of trainers
    Route::get('/admin/count/trainer', [AdminController::class, 'trainer_count']);

    // View all users
    Route::get('/admin/users', [UserController::class, 'index']);

    // View specific user
    Route::get('/admin/user/{id}', [UserController::class, 'show']);

    // Update a user

    Route::put('/admin/user/{id}', [UserController::class, 'update']);

    // Delete a user
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy']);

    // View pending trainer applications

    Route::get('/pending/trainers', [TrainerController::class, 'pending_trainer']);

    // Approve a trainer application

    Route::post('/approve/trainer/{id}', [TrainerController::class, 'trainer_approve']);

    // View specific trainer details

    Route::get('/admin/trainer/{id}', [TrainerController::class, 'show']);

    // Update trainer details

    Route::put('/admin/trainer/{id}', [TrainerController::class, 'update']);

    // Delete a trainer

    Route::delete('/admin/trainer/{id}', [TrainerController::class, 'destroy']);

    // View all seminars (admin-level access to trainer seminars)

    Route::get('admin/trainer/seminar', [SeminarController::class, 'trainer_index']);
});


/*
|--------------------------------------------------------------------------
| Public Utility Routes
|--------------------------------------------------------------------------
*/

// Find nearest gyms based on location data

Route::post('/find_nearest_gyms', [GymController::class, 'findNearestGyms']);

// Get all approved trainers

Route::get('/trainers', [TrainerController::class, 'index']);




// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
