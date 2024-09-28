<?php

namespace App\Services\Settings;

use App\Repositories\Settings\AccessLevelUserRepository;


class AccessLevelUserService
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct()
    {
        $this->repository = new AccessLevelUserRepository();
    }


    public function getAllAccessLevels(): object
    {
        return $this->repository->getAllAccessLevels();
    }


    public function getUserAccessLevel($id)
    {
        //dd($id);
        $level = $this->repository->getUserAccessLevel($id);

        return $level;
    }


}
