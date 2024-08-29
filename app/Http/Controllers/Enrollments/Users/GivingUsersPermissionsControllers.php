<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GivingUsersPermissionsControllers extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'permissions' => ['required', 'array'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response('User not found', 404);
        }

        $user->syncPermissions($validated['permissions']);

        return response()->noContent(Response::HTTP_OK);
    }
}
