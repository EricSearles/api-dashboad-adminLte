<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserAccessLevel;
use App\Services\AccessLevelService;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;
    protected $accessLevelService;

    /**
     * @param $accessLevelService
     */
    public function __construct(UserService $userService, AccessLevelService $accessLevelService)
    {
        $this->userService = $userService;
        $this->accessLevelService = $accessLevelService;
    }


    public function index()
    {
        //$users = $this->userService->getUsers();
        $users = $this->userService->getUsersWithEnderecoStatusPaginated(10);
        $accessLevels = $this->userService->getAllAccessLevels();


        return view('users.index', compact('users', 'accessLevels'));
    }

    public function getUserByType($type_id)
    {
        //        $users = User::whereHas('userTypes', function ($query) use ($type_id)  {
        //                $query->where('type_of_user_id', $type_id); // Ajuste o ID do tipo conforme necessário
        //                })->paginate(10); // Ajuste o número de itens por página conforme necessário
        $users = $this->userService->getUserByType($type_id);
        $accessLevels = $this->userService->getAllAccessLevels();

        return view('users.index', compact('users', 'accessLevels'));
    }

    public function showAddEnderecoForm($id)
    {
        $user = $this->userService->getUserWithEnderecos($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado');
        }

        return view('users.add-endereco', compact('user'));
    }

    public function addEndereco(Request $request, $id)
    {
        $request->validate([
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:10',
            'pais' => 'required|string|max:255',
        ]);

        try {
            $this->userService->addEnderecoToUser($id, $request->all());

            return redirect()->route('users.show', $id)->with('success', 'Endereço adicionado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function buscaDadosUsuario($id)
    {
        return "OI";
    }

    public function editaDadosUsuario($id)
    {
        return "Edita";
    }

    public function deletaDadosUsuario($id)
    {
        dd("delete");
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso.');
    }

    public function retornaUsuarios()
    {
        $users = User::with('accessLevels')->paginate();

        return response()->json([
            'results' => $users
        ], 200);
    }
}
