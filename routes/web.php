<?php

use App\Http\Controllers\AccessLevelController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

     Route::get('users', [UserController::class, 'index'])->name('users');
     Route::get('users/{id}', [UserController::class, 'exibeDadosUsuario'])->name('users.show');
     Route::put('users/edit/{id}', [UserController::class, 'editarDadosUsuario'])->name('users.edit');
     Route::delete('users/{id}', [UserController::class, 'deletaDadosUsuario'])->name('users.destroy');
    //  Route::get('users/type/{type_id}', [UserController::class, 'getUserByType'])->name('users.type');

    Route::get('/user/{id}/add-endereco', [UserController::class, 'showAddEnderecoForm'])->name('user.add-endereco-form');
    Route::post('/user/{id}/add-endereco', [UserController::class, 'addEndereco'])->name('user.add-endereco');
    Route::get('/user/{id}/add-contato', [UserController::class, 'showAddContatoForm'])->name('user.add-contato-form');
    Route::post('/user/{id}/add-contato', [UserController::class, 'addContato'])->name('user.add-contato');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

   // Route::get('clients/type/{type_id}', [ClientController::class, 'getClients'])->name('clients.type');

    Route::get('access-level', [AccessLevelController::class, 'getAllAccessLevels'])->name('access-level.getAllAccessLevels');
    Route::get('menus', [Settings\MenuController::class, 'index'])->name('menu.index');

    Route::get('clients', [ClientController::class, 'index'])->name('clients');
    Route::get('clients/{id}', [ClientController::class, 'exibeDadosCliente'])->name('clients.show');
    Route::put('clients/edit/{id}', [ClientController::class, 'editarDadosCliente'])->name('clients.edit');
    Route::delete('clients/{id}', [ClientController::class, 'deletaDadosCliente'])->name('clients.destroy');
    Route::get('/client/{id}/add-endereco', [ClientController::class, 'showAddEnderecoForm'])->name('client.add-endereco-form');
    Route::post('/client/{id}/add-endereco', [ClientController::class, 'addEndereco'])->name('client.add-endereco');
    Route::get('/client/{id}/add-contato', [ClientController::class, 'showAddContatoForm'])->name('client.add-contato-form');
    Route::post('/client/{id}/add-contato', [ClientController::class, 'addContato'])->name('client.add-contato');
});
