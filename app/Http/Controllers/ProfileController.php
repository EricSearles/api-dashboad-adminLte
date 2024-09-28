<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

use App\Services\UserService;
use App\Models\Endereco;

class ProfileController extends Controller
{
    protected $userService;
    protected $endereco;

    public function __construct(UserService $userService, Endereco $endereco)
    {
        $this->userService = $userService;
        $this->endereco = $endereco;
    }


    public function show()
    {
        $user = auth()->user();
        $userWithEnderecos = $this->userService->getUserWithEnderecos($user->id);

        return view('auth.profile', compact('userWithEnderecos'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validação dos dados de perfil e endereços
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'enderecos.*.rua' => 'nullable|string|max:255',
            'enderecos.*.cidade' => 'nullable|string|max:255',
            'enderecos.*.estado' => 'nullable|string|max:255',
            'enderecos.*.cep' => 'nullable|string|max:20',
        ]);

        // Atualizar nome e email
        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
            // Apenas atualizar a senha se ela foi fornecida
        //     'password' => $request->password ? bcrypt($request->password) : $user->password,
        // ]);

        // Atualizar ou criar endereços
        if ($request->has('enderecos')) {
            foreach ($request->enderecos as $index => $enderecoData) {
                if (isset($enderecoData['id'])) {
                    // Atualizar endereço existente
                    $endereco = Endereco::find($enderecoData['id']);
                    if ($endereco && $endereco->addressable_id == $user->id && $endereco->addressable_type == get_class($user)) {
                        $endereco->update($enderecoData);
                    }
                } else {
                    // Criar novo endereço
                   // $user->enderecos()->create($enderecoData);
                }
            }
        }

        return redirect()->route('profile.show')->with('success', 'Perfil atualizado com sucesso!');
    }
}