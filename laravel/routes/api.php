<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Project\ProjectApplicationController;
use App\Http\Controllers\Project\ProjectController;

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
Route::middleware(['auth', 'web'])->get('/user', function (Request $request) {
    return $request->user();
});
// return project list
Route::get('/projects/all', [ProjectController::class, 'getProjectList']);
Route::get('/projects/{id}', [ProjectController::class, 'getProjectById']);

// register new user
Route::post('/register', [RegisterController::class, 'register']);
// login user
Route::post('/login', [AuthController::class, 'login'])->middleware('web');
// logout user
Route::post('/logout', [AuthController::class, 'logout'])->middleware('web');
// applications
Route::post('/applications', [ProjectApplicationController::class, 'postApplication']);

// project routes
Route::apiResource('project', ProjectController::class);
Route::middleware('auth:sanctum')->get('/sent-applications', [ProjectApplicationController::class, 'getSentApplications']);// for the developer to view their sent applications
Route::middleware('auth:sanctum')->get('/received-applications', [ProjectApplicationController::class, 'getReceivedApplications']);
