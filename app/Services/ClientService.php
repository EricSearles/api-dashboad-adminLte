<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{

    private $clientRepository;
    protected $enderecoService;

    public function __construct(ClientRepository $clientRepository, EnderecoService $enderecoService)
    {
        $this->clientRepository = $clientRepository;
        $this->enderecoService = $enderecoService;
    }

    public function addEnderecoToClient($clientId, $enderecoData)
    {
        $client = $this->clientRepository->find($clientId);

        if (!$client) {
            throw new \Exception('Usuário não encontrado');
        }

        return $this->enderecoService->addEnderecoToModel($client, $enderecoData);
    }

    public function getClientWithEnderecos($clientId)
    {
        return $this->clientRepository->getClientWithEnderecos($clientId);
    }

    //verifica se o usuario possui endereco cadastrado
    public function clientHasEndereco($clientId)
    {
        return $this->clientRepository->hasEndereco($clientId);
    }

    public function getCLientsWithEnderecoStatusPaginated($perPage = 10)
    {
        $paginatedClients = $this->clientRepository->paginateClients($perPage);

        foreach ($paginatedClients as $client) {
            $client->hasEndereco = $this->clientRepository->hasEndereco($client->id);
        }

        return $paginatedClients;
    }

    public function getClientWithAll($userId)
    {
        return $this->clientRepository->getClientWithAll($userId);
    }

    public function getClientWithContatos($clientId)
    {
        return $this->clientRepository->getClientWithContatos($clientId);
    }


}
