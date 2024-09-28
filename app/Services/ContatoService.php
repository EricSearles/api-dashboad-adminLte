<?php

namespace App\Services;

use App\Repositories\ContatoRepository;

class ContatoService
{
    protected $contatoRepository;

    /**
     * @param $contatoRepository
     */
    public function __construct(ContatoRepository $contatoRepository)
    {
        $this->contatoRepository = $contatoRepository;
    }

    public function addContatoToModel($model, $contatoData)
    {
        return $this->contatoRepository->saveContato($model, $contatoData);
    }


}
