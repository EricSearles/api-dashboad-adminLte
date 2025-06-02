<?php

namespace App\Http\Controllers;

use App\Services\ProfessionalService;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    protected $professionalService;

    public function __construct(ProfessionalService $professionalService)
    {
        $this->professionalService = $professionalService;
    }

    public function index()
    {
        $professionals = $this->professionalService->getAllProfessionals();
        return view('professionals.index', compact('professionals'));
    }

    public function exibeDadosProfissional($id)
    {
        $professional = $this->professionalService->getProfessional($id);
        return view('professionals.show', compact('professional'));
    }

    public function create()
    {
        return view('professionals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professionals,email',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $this->professionalService->createProfessional($data);

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $professional = $this->professionalService->getProfessional($id);
        return view('professionals.edit', compact('professional'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:professionals,email,' . $id,
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $this->professionalService->updateProfessional($id, $data);

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional atualizado com sucesso!');
    }

    public function schedules($id)
    {

    }

    public function destroy($id)
    {
        $this->professionalService->deleteProfessional($id);

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional removido com sucesso!');
    }
}
