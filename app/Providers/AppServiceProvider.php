<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Settings\MenuRepository;
use App\Services\Settings\MenuService;

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
