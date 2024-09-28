<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use App\Services\ClientService;


class HomeController extends Controller
{

    protected $userService;
    protected $clientService;

    public function __construct(UserService $userService, ClientService $clientService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->clientService = $clientService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::with('accessLevels')->paginate();
        $userCount = $this->userService->getUserCount();
        $clientCount = $this->clientService->getClientCount();
        return view('home', compact('users', 'userCount', 'clientCount'));
    }
}
