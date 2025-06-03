<?php

namespace App\Repositories;

use App\Models\Schedule;

class ScheduleRepository
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function getAllSchedules()
    {
        return $this->schedule->all();
    }

    public function create(array $data)
    {
        return $this->schedule->create($data);
    }

    public function getAvailableSchedules($professionalId, $date)
    {
        return $this->schedule->where('professional_id', $professionalId)
            ->where('date', $date)
            ->where('available', true)
            ->get();
    }

    public function find($id)
    {
        return $this->schedule->findOrFail($id);
    }

    public function updateAvailability($id, $available)
    {
        $schedule = $this->find($id);
        $schedule->available = $available;
        return $schedule->save();
    }

    public function paginate($perPage = 15)
    {
        return $this->schedule->with('professional')
            ->orderBy('date')
            ->paginate($perPage);
    }
}
