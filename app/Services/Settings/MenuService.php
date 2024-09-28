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

    public function getAccessibleMenusForUser(User $user)
    {
        $accessLevelIds = $user->accessLevels->pluck('id');
        // $teste = $this->repository->getMenusByAccessLevels($accessLevelIds);
        // foreach($teste as $menu){
        //     var_dump($menu);
        // };

        // die("AAA");
        return $this->repository->getMenusByAccessLevels($accessLevelIds);
    }

    


    public function getUserMenuLeft($userId)
    {
        return $this->repository->getUserMenuLeft($userId);
    }

}
