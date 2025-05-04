<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$request->has('amount') || !is_numeric($request->amount)) {
            return response()->json(['error' => 'Missing or invalid transfer amount'], 400);
        }

        $amount = intval($request->amount);

        if ($user->credit < $amount) {
            return response()->json(['error' => 'Insufficient credit'], 403);
        }

        return $next($request);
    }
}
