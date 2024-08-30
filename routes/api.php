<?php

use App\Http\Controllers\{Enrollments\Users\ActiveUserController,
    Enrollments\Users\DeactiveUserController,
    RolesAndPermissionsController,
    UpdateUserController};
use App\Http\Controllers\Enrollments\Users\{CreateUserController,
    GetUserController,
    GetUserPermissionsController,
    GivingUsersPermissionsControllers,
    ListUsersControllers,
    MenuController,
    SettingUsersNotificationsController};
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('/permissions', [RolesAndPermissionsController::class, 'rolesAndPermissions']);
    Route::get('/all', [RolesAndPermissionsController::class, 'allRoles']);
    Route::get('/user-permissions', [RolesAndPermissionsController::class, 'getAuthenticatedUserPermissions']);
});

Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'getMenu']);
});

Route::prefix('user')->group( callback: function () {

    Route::group([], function () {
        Route::post('/create', CreateUserController::class);
        Route::get('/list', ListUsersControllers::class);
        Route::post('/active', ActiveUserController::class);
        Route::post('/deactivate', DeactiveUserController::class);
        Route::post('/get', GetUserController::class);
        Route::post('/update', UpdateUserController::class);
    });

    Route::prefix('permissions')->group(function () {
        Route::post('/get', GetUserPermissionsController::class);
        Route::post('/', GivingUsersPermissionsControllers::class);
    });

    Route::prefix('notifications')->group(function () {
        Route::post('/', SettingUsersNotificationsController::class);
    });
});
