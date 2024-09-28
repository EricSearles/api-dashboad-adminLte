<?php

namespace App\Repositories\Settings;

use App\Models\Menu;

class MenuRepository
{
    protected $entity;

    /**
     * @param $entity
     */
    public function __construct()
    {
        $this->entity = new Menu();
    }

    public function getAllMenus()
    {
        return $this->entity::orderBy('order')->get();
    }

    public function getMenusByAccessLevels($accessLevelIds)
    {
        return Menu::whereHas('accessLevels', function($query) use ($accessLevelIds) {
            $query->whereIn('access_levels.id', $accessLevelIds);
        })->get();
    }



    public function getUserMenuLeft($userId)
    {
        //return Menu::all()->where()
    }


}
