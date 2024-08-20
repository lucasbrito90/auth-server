<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsController extends Controller
{
    public function rolesAndPermissions(): array
    {
        $roles = Role::all('name', 'id');

        $rolesAndPermissions = [];

        $roles->each(function ($role) use (&$rolesAndPermissions) {
            $rolesAndPermissions[$role->name] = $role->permissions->pluck('name');
        });

        return $rolesAndPermissions;
    }

    public function allRoles(): \Illuminate\Support\Collection
    {
        return Role::with('permissions:name')->all()->pluck('name');
    }

    public function getAuthenticatedUserPermissions(Request $request): JsonResponse
    {
        if (!auth()->guard('api')->check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json(
            auth()->guard('api')->user()->getPermissionNames()
        );
    }
}
