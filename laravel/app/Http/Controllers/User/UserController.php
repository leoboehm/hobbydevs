<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return response()->json($user);
}
