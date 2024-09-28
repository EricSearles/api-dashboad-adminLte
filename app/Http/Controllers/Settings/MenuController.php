<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Settings\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    /**
     * @param $menuService
     */
    public function __construct()
    {
        $this->menuService = new MenuService();
    }

    public function getAllMenus()
    {
        $menuscontroller = $this->menuService->getAllMenus();

        return view('./layouts/navigation', compact($menuscontroller));
    }

    public function getUserMenus($userId)
    {

    }

    public function getUserMenuLeft()
    {


    }


}
