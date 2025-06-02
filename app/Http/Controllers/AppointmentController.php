<?php

namespace App\Http\Controllers;

use App\Services\AppointmentService;
use App\Services\ProfessionalService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentService;
    protected $professionalService;

    public function __construct(
        AppointmentService $appointmentService,
        ProfessionalService $professionalService
    ) {
        $this->appointmentService = $appointmentService;
        $this->professionalService = $professionalService;
    }

    public function index()
    {
        $professionals = $this->professionalService->getAllProfessionals();
        return view('appointments.index', compact('professionals'));
    }

    public function calendar()
    {
        $professionals = $this->professionalService->getAllProfessionals();
        return view('appointments.calendar', compact('professionals'));
    }

    public function calendarData(Request $request)
    {
        $professionalId = $request->query('professional_id');
        $events = $this->appointmentService->getCalendarEvents($professionalId);
        
        return response()->json($events);
    }

    public function getProfessionalAppointments($professionalId)
    {
        $appointments = $this->appointmentService->getProfessionalAppointments($professionalId);
        return response()->json($appointments);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,canceled,completed',
        ]);

        $this->appointmentService->updateAppointmentStatus($id, $request->status);

        return response()->json(['message' => 'Status do agendamento atualizado com sucesso!']);
    }
}
