<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\Token;

class GetUserByAccessTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $access_token = $request->header('Authorization');
        $auth_header = explode(' ', $access_token);
        $token = $auth_header[1];
        $token_parts = explode('.', $token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];

        $user = Token::find($token_id)->user;

        if (!$user) {
            return response('User not found', 404);
        }

        return $user;
    }
}
