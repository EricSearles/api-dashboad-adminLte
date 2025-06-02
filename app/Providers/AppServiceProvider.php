<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Settings\MenuRepository;
use App\Services\Settings\MenuService;
use App\Models\Professional; // Adicione esta linha
use App\Models\Schedule;    // Adicione esta linha
use App\Models\Appointment; // Adicione esta linha
use App\Repositories\ProfessionalRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\AppointmentRepository;
use App\Services\ProfessionalService;
use App\Services\ScheduleService;
use App\Services\AppointmentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MenuRepository::class, function ($app) {
            return new MenuRepository();
        });

        $this->app->singleton(MenuService::class, function ($app) {
            return new MenuService($app->make(MenuRepository::class));
        });

        // Repositories
        $this->app->bind(ProfessionalRepository::class, function ($app) {
            return new ProfessionalRepository($app->make(Professional::class));
        });

        $this->app->bind(ScheduleRepository::class, function ($app) {
            return new ScheduleRepository($app->make(Schedule::class));
        });

        $this->app->bind(AppointmentRepository::class, function ($app) {
            return new AppointmentRepository($app->make(Appointment::class));
        });

        // Services
        $this->app->bind(ProfessionalService::class, function ($app) {
            return new ProfessionalService($app->make(ProfessionalRepository::class));
        });

        $this->app->bind(ScheduleService::class, function ($app) {
            return new ScheduleService($app->make(ScheduleRepository::class));
        });

        $this->app->bind(AppointmentService::class, function ($app) {
            return new AppointmentService(
                $app->make(AppointmentRepository::class),
                $app->make(ScheduleRepository::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
