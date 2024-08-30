<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserPermissionsController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        return response()->json($user->getPermissionNames());
    }
}
