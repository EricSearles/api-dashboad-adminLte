<?php

namespace App\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentRepository
{
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function create(array $data)
    {
        return $this->appointment->create($data);
    }

    public function getUserAppointments($userId)
    {
        return $this->appointment->where('user_id', $userId)
            ->with(['professional', 'schedule'])
            ->get();
    }

    public function getProfessionalAppointments($professionalId)
    {
        return $this->appointment->where('professional_id', $professionalId)
            ->with(['user', 'schedule'])
            ->get();
    }

    public function find($id)
    {
        return $this->appointment->findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        $appointment = $this->find($id);
        $appointment->status = $status;
        return $appointment->save();
    }

    public function getCalendarData($professionalId = null)
    {
        $query = $this->appointment->with(['professional', 'client', 'schedule'])
            ->whereHas('schedule', function($q) {
                $q->where('date', '>=', Carbon::now()->subMonths(3));
            });

        if ($professionalId) {
            $query->where('professional_id', $professionalId);
        }

        return $query->get();
    }
}
