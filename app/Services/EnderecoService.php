<?php

namespace App\Services;

use App\Repositories\EnderecoRepository;

class EnderecoService
{
    protected $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    public function addEnderecoToModel($model, $enderecoData)
    {
        return $this->enderecoRepository->saveEndereco($model, $enderecoData);
    }
}
