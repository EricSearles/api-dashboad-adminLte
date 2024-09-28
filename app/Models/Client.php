<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clientes';

    use HasFactory;

    public function enderecos()
    {
        return $this->morphMany(Endereco::class, 'addressable');
    }

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'addressable');
    }
}
