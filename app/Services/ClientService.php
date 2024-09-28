<?php

namespace App\Services;

use App\Services\UserService;
use App\Services\AccessLevelService;

class ClientService
{

    private $userService;
    private $accessLevelService;

    public function __construct(UserService $userService, AccessLevelService $accessLevelService)
    {
        $this->userService = $userService;
        $this->accessLevelService = $accessLevelService;
    }

    public function getClients($type_id)
    {
        return $this->userService->getUserByType($type_id);
    }

    public function getAllAccessLevels()
    {
        return $this->accessLevelService->getAllAccessLevel();
    }


}
