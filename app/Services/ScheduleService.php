<?php

namespace App\Services;

use App\Repositories\ScheduleRepository;

class ScheduleService
{
    protected $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }
    public function getAllSchedules()
    {
        return $this->scheduleRepository->getAllSchedules();
    }

    public function createSchedule(array $data)
    {
        return $this->scheduleRepository->create($data);
    }

    public function getAvailableSchedules($professionalId, $date)
    {
        return $this->scheduleRepository->getAvailableSchedules($professionalId, $date);
    }

    public function updateScheduleAvailability($id, $available)
    {
        return $this->scheduleRepository->updateAvailability($id, $available);
    }

    public function getPaginatedSchedules($perPage = 15)
    {
        return $this->scheduleRepository->paginate($perPage);
    }

    
}
