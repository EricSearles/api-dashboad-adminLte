<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ClientService;

class ClientController extends Controller
{

    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getClients($type_id)
    {
        $users = $this->clientService->getClients($type_id);
        $accessLevels = $this->clientService->getAllAccessLevels();

        return view('clients.index', compact('users','accessLevels'));
    }

}
