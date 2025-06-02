<?php

namespace App\Repositories;

use App\Models\Professional;

class ProfessionalRepository
{
    protected $professional;

    public function __construct(Professional $professional)
    {
        $this->professional = $professional;
    }

    public function all()
    {
        return $this->professional->all();
    }

    public function create(array $data)
    {
        return $this->professional->create($data);
    }

    public function find($id)
    {
        return $this->professional->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $professional = $this->find($id);
        return $professional->update($data);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
