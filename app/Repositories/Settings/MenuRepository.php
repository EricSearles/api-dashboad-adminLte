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

    public function getActiveMenus()
    {
        return $this->entity::where('status', 1)
                        ->orderBy('order')
                        ->get();
    }

    public function getMenusByAccessLevels($accessLevelIds)
    {   
        return Menu::with('children')
        ->where('status_id', 1) // Filtra por status na tabela menus
        ->whereHas('accessLevels', function($query) use ($accessLevelIds) {
            $query->whereIn('access_levels.id', $accessLevelIds); // Filtra pela relação com access_levels
        })->orderBy('order')
        ->get();
        
    }

    public function getUserMenuLeft($userId)
    {
        //return Menu::all()->where()
    }

    public function paginate($perPage)
    {
        return $this->entity::orderBy('order')->paginate($perPage);
    }

    public function store($data)
    {
        return $this->entity::create($data);
    }
    public function update($data, $id)
    {
        $menu = $this->entity::find($id);
        if ($menu) {
            $menu->update($data);
            return $menu;
        }
        return null;
    }
    public function status($id)
    {
        $menu = $this->entity::find($id);
        if ($menu) {
            $menu->status_id = !$menu->status_id;
            $menu->save();
            return $menu;
        }
        return null;
    }
    public function destroy($id)
    {
        $menu = $this->entity::find($id);
        if ($menu) {
            $menu->delete();
            return true;
        }
        return false;
    }
    public function getMenuById($id)
    {
        return $this->entity::find($id);
    }


}
