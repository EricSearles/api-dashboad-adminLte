<?php

use App\Http\Controllers\AccessLevelController;
use Illuminate\Support\Facades\Route;

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

     Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
     Route::get('users/{id}', [\App\Http\Controllers\UserController::class, 'buscaDadosUsuario'])->name('users.show');
     Route::put('users/edit/{id}', [\App\Http\Controllers\UserController::class, 'editarDadosUsuario'])->name('users.edit');
     Route::delete('users/{id}', [\App\Http\Controllers\UserController::class, 'deletaDadosUsuario'])->name('users.destroy');
    //  Route::get('users/type/{type_id}', [\App\Http\Controllers\UserController::class, 'getUserByType'])->name('users.type');

    Route::get('/user/{id}/add-endereco', [\App\Http\Controllers\UserController::class, 'showAddEnderecoForm'])->name('user.add-endereco-form');
    Route::post('/user/{id}/add-endereco', [\App\Http\Controllers\UserController::class, 'addEndereco'])->name('user.add-endereco');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

   // Route::get('clients/type/{type_id}', [\App\Http\Controllers\ClientController::class, 'getClients'])->name('clients.type');

    Route::get('access-level', [\App\Http\Controllers\AccessLevelController::class, 'getAllAccessLevels'])->name('access-level.getAllAccessLevels');
    Route::get('menus', [\App\Http\Controllers\Settings\MenuController::class, 'index'])->name('menu.index');

    Route::get('clients', [\App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
});
