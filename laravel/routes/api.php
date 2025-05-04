<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
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
    return $request->user();
});


// register new user
Route::post('/register', [RegisterController::class, 'register']);
// login user
Route::middleware('web')->post('/login', [AuthController::class, 'login']);
// logout user
Route::middleware(['auth:sanctum', 'web'])->post('/logout', [AuthController::class, 'logout']);
// applications
Route::middleware('auth:sanctum')->post('/applications', [ProjectApplicationController::class, 'postApplication']);

// project
Route::apiResource('project', ProjectController::class);
Route::put('/projects/{id}', [ProjectController::class, 'update'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/sent-applications', [ProjectApplicationController::class, 'getSentApplications']);
Route::middleware('auth:sanctum')->get('/received-applications', [ProjectApplicationController::class, 'getReceivedApplications']);

Route::middleware('auth:sanctum')->put('/user', [UserController::class, 'update']);

// project
Route::apiResource('project', ProjectController::class);
// category
Route::apiResource('category', ProjectCategoryController::class);
// skill
Route::apiResource('skill', ProjectSkillController::class);

// credittransfer
Route::post('/payment',[TransferController::class,'transfer']);
