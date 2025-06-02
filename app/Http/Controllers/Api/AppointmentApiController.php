<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\ProfessionalService;

class AppointmentApiController extends Controller
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
        return view('admin.appointments.index', compact('professionals'));
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
