<?php

namespace App\Http\Controllers\Enrollments\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListUsersControllers extends Controller
{
    public function __invoke(Request $request)
    {
        $paginate = $request->input('limit', 10);

            return DB::table('users')
                ->when($request->name, function ($query, $name) {
                    return $query->where('name', 'like', "%$name%");
                })
                ->when($request->email, function ($query, $email) {
                    return $query->where('email', 'like', "%$email%");
                })
                ->when($request->role, function ($query, $role) {
                    return $query->where('role', 'like', "%$role%");
                })
                ->when($request->sector, function ($query, $sector) {
                    return $query->where('sector', 'like', "%$sector%");
                })
                ->when($request->phone_number, function ($query, $phone_number) {
                    return $query->where('phone_number', 'like', "%$phone_number%");
                })
                ->paginate($paginate);


    }
}
