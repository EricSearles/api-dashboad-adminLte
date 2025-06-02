<?php

use App\Http\Controllers\AccessLevelController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\MenuController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;

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
    Route::get('menus', [MenuController::class, 'index'])->name('menu.index');

    Route::get('clients', [ClientController::class, 'index'])->name('clients');
    Route::get('clients/{id}', [ClientController::class, 'exibeDadosCliente'])->name('clients.show');
    Route::put('clients/edit/{id}', [ClientController::class, 'editarDadosCliente'])->name('clients.edit');
    Route::delete('clients/{id}', [ClientController::class, 'deletaDadosCliente'])->name('clients.destroy');
    Route::get('/client/{id}/add-endereco', [ClientController::class, 'showAddEnderecoForm'])->name('client.add-endereco-form');
    Route::post('/client/{id}/add-endereco', [ClientController::class, 'addEndereco'])->name('client.add-endereco');
    Route::get('/client/{id}/add-contato', [ClientController::class, 'showAddContatoForm'])->name('client.add-contato-form');
    Route::post('/client/{id}/add-contato', [ClientController::class, 'addContato'])->name('client.add-contato');

    Route::get('agenda', [AppointmentController::class, 'index'])->name('agenda');
    Route::get('agenda/calendar', [AppointmentController::class, 'calendar'])->name('agenda.calendar');
    Route::get('/agenda/calendar/data', [AppointmentController::class, 'calendarData'])->name('appointments.calendar.data');

    // Rotas para Profissionais
    //Route::resource('profissionais', [ProfessionalController::class, 'index'])->name('profissionais');
    Route::get('profissionais', [ProfessionalController::class, 'index'])->name('profissionais');
    Route::get('profissionais/{id}', [ProfessionalController::class, 'exibeDadosProfissional'])->name('profissionais.show');
    Route::get('profissionais/edit/{id}', [ProfessionalController::class, 'edit'])->name('profissionais.edit');
    Route::get('profissionais/create', [ProfessionalController::class, 'create'])->name('profissionais.create');
    Route::get('profissionais/schedules/{id}', [ProfessionalController::class, 'schedule'])->name('profissionais.schedules');
    Route::get('profissionais/agenda/{id}', [ProfessionalController::class, 'agenda'])->name('profissionais.agenda');
    Route::get('profissionais/destroy/{id}', [ProfessionalController::class, 'destroy'])->name('profissionais.destroy');
    Route::post('profissionais', [ProfessionalController::class, 'store'])->name('profissionais.store');
    // Route::get('profissionais/available', [ProfessionalController::class, 'getAvailableSchedules'])->name('profissionais.available');

    // Rotas para Horários
    Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules');
    Route::get('schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::get('schedules/edit/{id}', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::post('schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('schedules/available', [ScheduleController::class, 'getAvailableSchedules'])->name('schedules.available');
    Route::get('schedules/destroy/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
    // Rotas para Agendamentos
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index')->name('agendamentos');
    Route::get('appointments/{professionalId}', [AppointmentController::class, 'getProfessionalAppointments'])->name('appointments.professional');
    Route::put('appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');

});
