<?php

namespace App\Http\Controllers;

use App\Services\ProfessionalService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;
    protected $professionalService;

    public function __construct(
        ScheduleService $scheduleService,
        ProfessionalService $professionalService
    ) {
        $this->scheduleService = $scheduleService;
        $this->professionalService = $professionalService;
    }

    public function index()
    {
        $professionals = $this->professionalService->getAllProfessionals();
        //$schedules = $this->scheduleService->getAllSchedules();
        $schedules = $this->scheduleService->getPaginatedSchedules(10); 
        //dd($professionals, $schedules);
        return view('schedules.index', compact('professionals', 'schedules'));
        
    }

    public function create()
    {
        $professionals = $this->professionalService->getAllProfessionals();
        return view('schedules.create', compact('professionals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'professional_id' => 'required|exists:professionals,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $this->scheduleService->createSchedule($data);

        return redirect()->route('schedules.index')
            ->with('success', 'Horário cadastrado com sucesso!');
    }

    public function getAvailableSchedules(Request $request)
    {
        $request->validate([
            'professional_id' => 'required|exists:professionals,id',
            'date' => 'required|date',
        ]);

        $schedules = $this->scheduleService->getAvailableSchedules(
            $request->professional_id,
            $request->date
        );

        return response()->json($schedules);
    }
}
