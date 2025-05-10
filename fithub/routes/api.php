<?php

use App\Http\Controllers\AppoinmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TrainerMiddleware;
use Pest\Plugins\Profile;

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
        Route::post('/update_profile',[ProfileController::class,'update']);
    });

    Route::middleware('auth:sanctum')->get('/get_profile', function (Request $request) {
        return response()->json($request->user()->profile); // assuming a one-to-one relation
    });

    Route::middleware('auth:sanctum')->post('/change-password', [AuthController::class, 'changePassword']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/premium-trainers', [TrainerController::class, 'premium']);
        Route::post('/select-trainer', [UserController::class, 'selectTrainer']);
        Route::get('/user-trainer', [UserController::class, 'getUserTrainer']);
        Route::post('/cancel-trainer', [UserController::class, 'cancelTrainer']);

    });

    Route::get('/memberships', [MembershipController::class, 'index']);
    Route::post('/subscribe-membership', [MembershipController::class, 'subscribe']);
    Route::middleware('auth:sanctum')->get('/my-membership', [MembershipController::class, 'myMembership']);
    #Route::middleware('auth:sanctum')->post('/cancel-membership', [MembershipController::class, 'cancel']);
    Route::post('/cancel-membership', [MembershipController::class, 'cancelMembership']);
    Route::middleware('auth:sanctum')->post('/profile/activate-membership', [MembershipController::class, 'activateMembership']);




});


Route::post('/find_nearest_gyms', [GymController::class, 'findNearestGyms']);






// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
