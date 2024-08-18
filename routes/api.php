<?php

use App\Http\Controllers\{MenuController, RolesAndPermissionsController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('/permissions', [RolesAndPermissionsController::class, 'rolesAndPermissions']);
    Route::get('/all', [RolesAndPermissionsController::class, 'allRoles']);
});

Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'getMenu']);
});
