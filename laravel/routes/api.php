<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ApplicationController;

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

// return user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register new user
Route::post('/register', [RegisterController::class, 'register']);
// login user
Route::post('/login', [AuthController::class, 'login']);
// logout user
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// applications
Route::post('/applications', [ApplicationController::class, 'store']);
