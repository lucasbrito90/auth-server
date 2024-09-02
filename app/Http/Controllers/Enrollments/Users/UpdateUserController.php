<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'date_of_birth' => 'nullable|date',
            'state_province' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        if (isset($validated['avatar'])) {
            $path = $request->file('avatar')->store('avatars');
            $validated['avatar'] = Storage::url($path);
        }

        if ($user) {
            $user->update($validated);
        }

        return response()->noContent(Response::HTTP_OK);
    }
}
