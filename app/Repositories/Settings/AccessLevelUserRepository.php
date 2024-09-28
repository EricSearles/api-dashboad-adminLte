<?php

namespace App\Repositories\Settings;


use Illuminate\Support\Facades\DB;

use App\Models\AccessLevelUser;



class AccessLevelUserRepository
{
    protected $entity;

    /**
     * @param $entity
     */
    public function __construct()
    {
        $this->entity = new AccessLevelUser();
    }


    /**
     * Retorna nivel de acesso de usuario pelo id do usuario
     * @param int $id
     */
    public function getUserAccessLevel(int $id)
    {
        dd($id, $this->entity);
        $query = $this->entity->where('user_id', $id)->first();

    }


    /**
     * Cria um novo nivel de acesso para usuario
     * @param array $accessLevel
     * @return object
     */
    public function createAccessLevel(array $accessLevel): object
    {
        return $this->entity->create($accessLevel);
    }

    /**
     * Atualiza dados de nivel de acesso de usuários
     * @param object $accessLevel
     * @param array $level
     * @return object
     */
    public function updateAccessLevel(object $accessLevel, array $level): object
    {
        return $accessLevel->update($level);
    }

    /**
     * Deleta nivel de acesso
     * @param object $accessLevel
     * @return mixed
     */
    public function deleteAccessLevel(object $accessLevel)
    {
        return $accessLevel->delete();
    }


}
