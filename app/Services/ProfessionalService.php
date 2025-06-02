<?php

namespace App\Services;

use App\Repositories\ProfessionalRepository;

class ProfessionalService
{
    protected $professionalRepository;

    public function __construct(ProfessionalRepository $professionalRepository)
    {
        $this->professionalRepository = $professionalRepository;
    }

    public function getAllProfessionals()
    {
        return $this->professionalRepository->all();
    }

    public function createProfessional(array $data)
    {
        return $this->professionalRepository->create($data);
    }

    public function getProfessional($id)
    {
        return $this->professionalRepository->find($id);
    }

    public function updateProfessional($id, array $data)
    {
        return $this->professionalRepository->update($id, $data);
    }

    public function deleteProfessional($id)
    {
        return $this->professionalRepository->delete($id);
    }
}
