<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Settings\PageService;

class PageController extends Controller
{
    protected $pageService;

    public function __construct()
    {
        $this->pageService = new PageService();
    }


}
