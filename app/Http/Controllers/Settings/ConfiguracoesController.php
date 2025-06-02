<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Settings\MenuService;

class ConfiguracoesController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function index()
    {
        $menus = $this->menuService->getPaginatedMenus();
       // dd($getMenus);
        return view('settings.menus.index', compact('menus'));
    }

    public function addMenu()
    {
        return view('settings.menus.add-menu');
    }
    public function editMenu($id)
    {
        $menu = $this->menuService->getPaginatedMenus($id);
        //return view('settings.menus.edit', compact('menu'));
    }
    public function storeMenu(Request $request)
    {
        //dd($request->all());
       // $this->menuService->storeMenu($request);
      //  return redirect()->route('settings.menu')->with('success', 'Menu adicionado com sucesso!');
    }
    public function updateMenu(Request $request, $id)
    {
        //dd($request->all());
       // $this->menuService->updateMenu($request, $id);
      //  return redirect()->route('settings.menu')->with('success', 'Menu atualizado com sucesso!');
    }

    public function statusMenu($id)
    {
        $this->menuService->statusMenu($id);
        return redirect()->route('settings.menu')->with('success', 'Status do menu atualizado com sucesso!');
    }
    public function destroyMenu($id)
    {
        //$this->menuService->destroyMenu($id);
       // return redirect()->route('settings.menu')->with('success', 'Menu deletado com sucesso!');
    }
}
