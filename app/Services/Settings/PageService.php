<?php

namespace App\Services\Settings;

use App\Repositories\Settings\PageRepository;

class PageService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PageRepository();
    }


}
