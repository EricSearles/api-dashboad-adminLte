<?php

namespace App\Repositories;

use App\Models\Contact;

class ContatoRepository
{
    public function saveContato($model, $contatoData)
    {
        return $model->enderecos()->create($contatoData);
    }
}
