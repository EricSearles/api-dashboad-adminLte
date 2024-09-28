<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    protected $repository;

    /**
     * @param $entity
     */
    public function __construct(Client $repository)
    {
        $this->repository = $repository;
    }



}
