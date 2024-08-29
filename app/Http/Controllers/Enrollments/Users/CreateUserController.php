<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Enrollments\Users\CreateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController extends Controller
{
    public function __invoke(CreateUserRequest $request): Application|\Illuminate\Http\Response|ResponseFactory
    {
        /** @var User $user */
        $user = User::create($request->safe()->except('permissions'));

        if ($user->wasRecentlyCreated) {
            return response($user, Response::HTTP_CREATED);
        }

        return response('User not created', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
