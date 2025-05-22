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
use App\Http\Controllers\CreditController;

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

// register new user
Route::post('/register', [RegisterController::class, 'register']);
// login user
Route::middleware('web')->post('/login', [AuthController::class, 'login']);
// logout user
Route::middleware(['auth:sanctum', 'web'])->post('/logout', [AuthController::class, 'logout']);
// applications
Route::post('/apply', [ProjectApplicationController::class, 'postApplication']);
Route::get('/sent-applications/{userId}', [ProjectApplicationController::class, 'getSentApplications']);
Route::get('/received-applications/{userId}', [ProjectApplicationController::class, 'getReceivedApplications']);

Route::put('/user', [UserController::class, 'update']);
Route::get('/developers', [UserController::class,'getDeveloperList']);
Route::get('/developers/{id}', [UserController::class,'getDeveloperById']);
// project
Route::apiResource('project', ProjectController::class);
// category
Route::apiResource('category', ProjectCategoryController::class);
// skill
Route::apiResource('skill', ProjectSkillController::class);
// payment
/*Route::middleware('auth:sanctum')->post('/credits/buy', [CreditController::class, 'buyCredits']);
Route::middleware('auth:sanctum')->post('/credits/spend', [CreditController::class, 'spendCredits']);
Route::middleware('auth:sanctum')->post('/credits/transfer', [CreditController::class, 'transferCredits']);
Route::middleware('auth:sanctum')->get('/credits', [CreditController::class, 'getCredits']);
*/
Route::get('credit', [CreditController::class,'getCredits']);
