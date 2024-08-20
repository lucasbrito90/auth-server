<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

class MenuController extends Controller
{
    public function getMenu(Request $request): JsonResponse
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

        $menu = file_get_contents(base_path('resources/js/menu.json'));
        $menuCollection = collect(json_decode($menu, true));


        $menuFiltered = $this->filterByPermission(
            $menuCollection,
            $user->getPermissionNames()
        );

        return response()->json(
            $menuFiltered
        );
    }

    function filterByPermission($items, Collection $permission): Collection {
        return collect($items)->map(function ($item) use ($permission) {
            if (isset($item['children'])) {
                // Recursively filters children
                $filteredChildren = $this->filterByPermission($item['children'], $permission);
                if ($filteredChildren->isNotEmpty()) {
                    $item['children'] = $filteredChildren->toArray();
                    return $item;
                }
            }

            // Checks if the item has the 'permission' key with the desired value
            if (isset($item['permission']) && $permission->contains($item['permission'])) {
                return $item;
            }

            return null;
        })->filter()->values();
    }
}
