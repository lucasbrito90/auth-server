<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        return User::where('email', $validated['email'])->firstOrFail();
    }
}
