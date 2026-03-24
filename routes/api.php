<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Project\ProjectApplicationController;
use App\Http\Controllers\Project\ProjectCategoryController;
use App\Http\Controllers\Project\ProjectSkillController;
use App\Http\Controllers\User\UserController;

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
Route::middleware(['web', 'auth:sanctum'])->get('/user', function (Request $request) {
    $userData = $request->user();
    $userData->skills = json_decode($userData->skills, true) ?: [];
    return $userData;
});

// auth
Route::middleware('web')->post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum', 'web'])->post('/logout', [AuthController::class, 'logout']);
// user
Route::put('/user', [UserController::class, 'update']);
Route::post('/register', [UserController::class, 'add']);
Route::get('/developers', [UserController::class,'getDeveloperList']);
Route::get('/developers/{id}', [UserController::class,'getDeveloperById']);
// project
Route::apiResource('project', ProjectController::class);
// category
Route::apiResource('category', ProjectCategoryController::class);
// skill
Route::apiResource('skill', ProjectSkillController::class);
// applications
Route::post('/apply', [ProjectApplicationController::class, 'postApplication']);
Route::get('/sent-applications/{userId}', [ProjectApplicationController::class, 'getSentApplications']);
Route::get('/received-applications/{userId}', [ProjectApplicationController::class, 'getReceivedApplications']);