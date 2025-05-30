<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;

class CreditController extends Controller
{

    /*public function buyCredits(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount', 10); // default 10 credits
        // Fake payment logic here
        $user->credits += $amount;
        $user->save();

        return response()->json(['credits' => $user->credits]);
    }

    public function spendCredits(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount', 1);
        if ($user->credits < $amount) {
            return response()->json(['error' => 'Not enough credits'], 400);
        }
        $user->credits -= $amount;
        $user->save();

        return response()->json(['credits' => $user->credits]);
    }

    public function transferCredits(Request $request)
    {
        $user = Auth::user();
        $recipientEmail = $request->input('recipient_email');
        $amount = $request->input('amount', 1);

        if ($user->credits < $amount) {
            return response()->json(['error' => 'Not enough credits'], 400);
        }

        $recipient = \App\Models\User::where('email', $recipientEmail)->first();
        if (!$recipient) {
            return response()->json(['error' => 'Recipient not found'], 404);
        }

        $user->credits -= $amount;
        $recipient->credits += $amount;

        $user->save();
        $recipient->save();

        return response()->json(['credits' => $user->credits]);
    }
*/
    public function getCredits(Request $request)
    {
        $user = User::find($request->id);
        return 0;
        //$user = $request->user();
        //return response()->json(['credits' => $user->credits]);
        //return response()->json(['credits' => $credits]);
        //return 12;
    }

    /*public function getCreditHistory(Request $request)
    {
        $user = Auth::user();
        // Assuming you have a CreditHistory model
        $history = $user->creditHistory()->get();
        return response()->json($history);
    }*/
}
