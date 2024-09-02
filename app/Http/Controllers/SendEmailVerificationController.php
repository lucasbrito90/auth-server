<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SendEmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        /** @var User $user */
        $user = User::where('email', $validated['email'])->first();


        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification email sent']);
    }
}
