<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingUsersNotificationsController extends Controller
{
    /** @throws \Throwable */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email'=> 'required|email',
            'email_notifications' => 'nullable|boolean',
            'sms_notifications' => 'nullable|boolean',
            'web_notifications' => 'nullable|boolean',
        ]);

        /** @var User $user */
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user->updateOrFail([
            'email_notifications' => $validated['email_notifications'],
            'sms_notifications' => $validated['sms_notifications'],
            'web_notifications' => $validated['web_notifications'],
        ]);

        return response()->noContent(Response::HTTP_OK);
    }
}
