<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json(['message' => 'Old password is incorrect'], 400);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();
    }
}
