<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function transfer(Request $request)
    {

        $request->validate([
            'to_id' => 'required|integer|exists:users,id',
            'to_name' => 'required|string',
            'amount' => 'required|integer|min:1',
        ]);

        $sender = Auth::user();
        $recipient = User::where('id', $request->to_id)
            ->where('name', $request->to_name)
            ->first();

        if (!$recipient) {
            return response()->json(['error' => 'Recipient not found or name does not match ID'], 404);
        }

        if ($sender->id === $recipient->id) {
            return response()->json(['error' => 'Cannot transfer to yourself'], 400);
        }

        if ($sender->credit < $request->amount) {
            return response()->json(['error' => 'Insufficient credit'], 400);
        }

        $sender->credit -= $request->amount;
        $recipient->credit += $request->amount;

        $sender->save();
        $recipient->save();

        return response()->json([
            'message' => 'Transfer successful',
            'from' => $sender->name,
            'to' => $recipient->name,
            'amount' => $request->amount
        ]);
    }
}
