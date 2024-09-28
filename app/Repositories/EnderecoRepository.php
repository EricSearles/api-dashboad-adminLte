<?php

namespace App\Repositories;

use App\Models\Endereco;

class EnderecoRepository
{
    public function saveEndereco($model, $enderecoData)
    {
        return $model->enderecos()->create($enderecoData);
    }
}
