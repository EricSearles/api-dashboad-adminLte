<?php

namespace App\Services;

use App\Repositories\AppointmentRepository;
use App\Repositories\ScheduleRepository;

class AppointmentService
{
    protected $appointmentRepository;
    protected $scheduleRepository;

    public function __construct(
        AppointmentRepository $appointmentRepository,
        ScheduleRepository $scheduleRepository
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function createAppointment(array $data)
    {
        // Marca o horário como indisponível
        $this->scheduleRepository->updateAvailability($data['schedule_id'], false);

        return $this->appointmentRepository->create($data);
    }

    public function getUserAppointments($userId)
    {
        return $this->appointmentRepository->getUserAppointments($userId);
    }

    public function getProfessionalAppointments($professionalId)
    {
        return $this->appointmentRepository->getProfessionalAppointments($professionalId);
    }

    public function updateAppointmentStatus($id, $status)
    {
        return $this->appointmentRepository->updateStatus($id, $status);
    }

    public function getCalendarEvents($professionalId = null)
    {
        $appointments = $this->appointmentRepository->getCalendarData($professionalId);

       // dd($appointments);
        
        return $appointments->map(function($appointment) {
            return $this->formatCalendarEvent($appointment);
        });
    }

    protected function formatCalendarEvent($appointment)
    {

       // dd($appointment);
        // Converta as strings para objetos Carbon
        $date = \Carbon\Carbon::parse($appointment->schedule->date);
        $isSunday = $date->isSunday();
        $startTime = \Carbon\Carbon::parse($appointment->schedule->start_time);
        $endTime = \Carbon\Carbon::parse($appointment->schedule->end_time);
        
        return [
            'id' => $appointment->id,
            'title' => $appointment->client->nome . ' - ' . $appointment->professional->name,
            'start' => $date->format('Y-m-d') . 'T' . $startTime->format('H:i:s'),
            'end' => $date->format('Y-m-d') . 'T' . $endTime->format('H:i:s'),
            //'color' => $this->getEventColor($appointment->status),
            'color' => $isSunday ? '#ffcccc' : $this->getEventColor($appointment->status),
            'description' => $this->getEventDescription($appointment),
            'extendedProps' => [
                'status' => $appointment->status,
                'professional' => $appointment->professional->name,
                'client' => $appointment->client->nome,
                'isSunday' => $isSunday
            ]
        ];
    }

    protected function getEventColor($status)
    {
        switch ($status) {
            case 'confirmed': return '#28a745';
            case 'pending': return '#ffc107';
            case 'canceled': return '#dc3545';
            case 'completed': return '#17a2b8';
            default: return '#007bff';
        }
    }

    protected function getEventDescription($appointment)
    {
        return "Profissional: " . $appointment->professional->name . "\n" .
               "Cliente: " . $appointment->client->nome . "\n" .
               "Horário: " . $appointment->schedule->start_time . " às " . $appointment->schedule->end_time . "\n" .
               "Status: " . ucfirst($appointment->status);
    }
}
