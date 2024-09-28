<?php

namespace App\Repositories;

use App\Models\TypesOfUsers;
use App\Models\User;

class UserRepository
{
    protected $model;

    /**
     * @param $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUsers()
    {
        return User::with('accessLevels')->paginate();
    }

    public function getUserByType(int $type_id): object
    {
        return User::whereHas('userTypes', function ($query) use ($type_id)
        {$query->where('type_of_user_id', $type_id); // Ajuste o ID do tipo conforme necessário
        })->paginate(10); // Ajuste o número de itens por página conforme necessário
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function paginateUsers($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function saveEndereco($user, $enderecoData)
    {
        return $user->enderecos()->create($enderecoData);
    }

    public function getUserWithEnderecos($id)
    {
        return $this->model->with('enderecos')->find($id);
    }

    //verifica se o usuario possui endereco cadastrado
    public function hasEndereco($id)
    {
        $user = $this->model->find($id);
        return $user && $user->enderecos()->exists();
    }


}
