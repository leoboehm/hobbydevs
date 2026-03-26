<?php

use Illuminate\Support\Facades\Route;

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

// user
Route::put('/user', [UserController::class, 'update']);
Route::post('/user', [UserController::class, 'add']);
Route::get('/user/{id}', [UserController::class,'getUserById']);
Route::get('/developers', [UserController::class,'getDeveloperList']);
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