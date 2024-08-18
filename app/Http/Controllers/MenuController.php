<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menu = file_get_contents(base_path('resources/js/menu.json'));
        return collect(json_decode($menu, true));
    }
}
