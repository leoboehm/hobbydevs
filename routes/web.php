<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// return user
Route::get('/user', function (Request $request) {
    $user  = $request->user();
    if (!$user) {
        return response()->json(null, 401);
    }

    $user->skills = json_decode($user->skills, true) ?: [];
    return $user;
});

// auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// redirects routing to Vue
Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '^(?!uml).*[\/\w\.-]*');
