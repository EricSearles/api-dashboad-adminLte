<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\AccessLevel;


class AccessLevelRepository
{
    protected $entity;

    /**
     * @param $entity
     */
    public function __construct()
    {
        $this->entity = new AccessLevel();
    }

    /**
     * Retorna todos os niveis de acesso de usuarios
     * @return object
     */
    public function
    getAllAccessLevels(): object
    {
        return $this->entity::all();
    }

    public function getUserAccessLevel()
    {
        $userAccessLevel = DB::table('access_level_user')
            ->join('users', 'access_levels.user_id', '=', 'users.id')
            ->join('access_levels', 'access_level_user.access_level_id', '=', 'access_levels.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'access_levels.user_role',
                'access_levels.id as level_id'
            )
            ->get();
        return  $userAccessLevel;
    }

    /**
     * Retorna nivel de acesso de usuario pelo id do nivel de acesso
     * @param int $id
     * @return object
     */
    public function getAccessLevelById(int $id): object
    {
        return $this->entity->where('user_id', $id)->first();
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
