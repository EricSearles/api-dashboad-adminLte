<?php

namespace App\Services\Settings;

use App\Repositories\Settings\MenuRepository;
use App\Models\User;

class MenuService
{
    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllMenus()
    {
        return $this->repository->getAllMenus(); 
    }

    public function getActiveMenus()
    {
        return $this->repository->getActiveMenus(); 
    }

    
    /**
     * este é o metodo que retorna os menus na barra lateral 
     * navigation-sidebar
     */
    public function getAccessibleMenusForUser(User $user)
    {
        $accessLevelIds = $user->accessLevels->pluck('id');
        return $this->repository->getMenusByAccessLevels($accessLevelIds);
    }

    public function getUserMenuLeft($userId)
    {
        return $this->repository->getUserMenuLeft($userId);
    }

    public function getPaginatedMenus($perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function storeMenu($request)
    {
        $data = $request->all();
       // $this->repository->store($data);
    }
    public function updateMenu($request, $id)
    {
        $data = $request->all();
      //  $this->repository->update($data, $id);
    }
    public function statusMenu($id)
    {
        $this->repository->status($id);
    }
    public function destroyMenu($id)
    {
      //  $this->repository->destroy($id);
    }

}
