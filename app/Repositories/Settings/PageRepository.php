<?php

namespace App\Repositories\Settings;

use App\Models\Page;

class PageRepository
{
    protected $entity;

    public function __construct()
    {
        $this->entity = new Page();
    }


}
