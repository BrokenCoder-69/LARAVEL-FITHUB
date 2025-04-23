<?php

use App\Http\Controllers\AppoinmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\SeminarController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/admin/dashboard', function () {
            return response()->json(['message' => 'Admin Dashboard']);
        });
    });

    Route::middleware(TrainerMiddleware::class)->group(function () {
        Route::get('/trainer/dashboard', function () {
            return response()->json(['message' => 'Trainer Dashboard']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user/dashboard', function () {
            return response()->json(['message' => 'User Dashboard']);
        });
        Route::post('/appointments', [AppoinmentController::class,'book']);
        Route::post('/seminar/store', [SeminarController::class,'book']);
        Route::get('/trainers', [AppoinmentController::class, 'trainer']);
    });
});


Route::post('/find_nearest_gyms', [GymController::class, 'findNearestGyms']);






// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
