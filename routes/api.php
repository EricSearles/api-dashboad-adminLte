<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AppointmentApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    Route::get('available-schedules', [AppointmentApiController::class, 'getAvailableSchedules']);
    Route::post('appointments', [AppointmentApiController::class, 'store']);
    Route::get('users/{userId}/appointments', [AppointmentApiController::class, 'getUserAppointments']);
});

Route::get('users', [UserController::class, 'retornaUsuarios']);
Route::get('user', [AuthController::class, 'getAuthUser']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name("login");
Route::get('logout', [AuthController::class, 'logout']);
