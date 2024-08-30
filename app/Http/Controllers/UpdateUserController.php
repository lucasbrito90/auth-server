<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'sector' => 'nullable|string',
            'role' => 'nullable|string',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        if ($user) {
            $user->update($validated);
        }

        return response()->noContent(Response::HTTP_OK);
    }
}
