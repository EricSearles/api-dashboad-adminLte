<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\AccessLevelService;

class UserService
{
    private $userRepository;
    private $accessLevelService;
    protected $enderecoService;

    public function __construct(
        UserRepository $userRepository,
        AccessLevelService $accessLevelService,
        EnderecoService $enderecoService
    ) {
        $this->userRepository = $userRepository;
        $this->accessLevelService = $accessLevelService;
        $this->enderecoService = $enderecoService;
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function getUserByType(int $type_id): object
    {
        return $this->userRepository->getUserByType($type_id);
    }

    public function getAllAccessLevels()
    {
        return $this->accessLevelService->getAllAccessLevel();
    }

    public function addEnderecoToUser($userId, $enderecoData)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        return $this->enderecoService->addEnderecoToModel($user, $enderecoData);
    }

    public function getUserWithEnderecos($userId)
    {
        return $this->userRepository->getUserWithEnderecos($userId);
    }

    public function getUserWithContatos($userId)
    {
        return $this->userRepository->getUserWithContatos($userId);
    }

    //verifica se o usuario possui endereco cadastrado
    public function userHasEndereco($userId)
    {
        return $this->userRepository->hasEndereco($userId);
    }

    public function getUsersWithEnderecoStatusPaginated($perPage = 10)
    {
        $paginatedUsers = $this->userRepository->paginateUsers($perPage);

        foreach ($paginatedUsers as $user) {
            $user->hasEndereco = $this->userRepository->hasEndereco($user->id);
        }

        return $paginatedUsers;
    }

    public function getUserWithAll($userId)
    {
        return $this->userRepository->getUserWithAll($userId);
    }

    public function addContatoToUser($userId, $contatoData)
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \Exception('Usuário não encontrado');
        }

        return $this->contatoService->addContatoToModel($user, $contatoData);
    }

    // Método para contar os usuários
    public function getUserCount()
    {
        return $this->userRepository->countUsers();
    }
}
