<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Logout
    Route::get('/logout', [AuthController::class, 'logout']);

    // Reports
    Route::post('send_report', [ReportController::class, 'store']);

    // Services
    Route::get('services/all', [ServiceController::class, 'index']);
    Route::get('services/all/{service}', [ServiceController::class, 'show']);

    // Users
    Route::get('users/{type}', [UserController::class, 'index']);
    Route::get('users/trainer/service/{service}', [UserController::class, 'getTrainersByService']);

    // Approvals
    Route::get('approvals', [UserController::class, 'getPendingTrainers']);
    Route::put('approvals/approve/{user}', [UserController::class, 'approveTrainer']);
    Route::put('approvals/reject/{user}', [UserController::class, 'rejectTrainer']);

    // Subscriptions
    Route::get('subscriptions', [SubscriptionController::class, 'index']);
    Route::post('subscriptions/subscribe', [SubscriptionController::class, 'subscribe']);
    Route::get('subscriptions/checkUserSubscriptionStatus', [SubscriptionController::class, 'checkUserSubscriptionStatus']);
    Route::put('subscriptions/{subscription}', [SubscriptionController::class, 'update']);
});
