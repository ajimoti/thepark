<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Locations\LocationsService;
use App\Services\Locations\FuellingProviders\ShellFuellingProvider;
use App\Services\Locations\FuellingProviders\BpFuellingProvider;
use App\Services\Locations\DataSource\ShellJsonFileDataSource;
use App\Services\Locations\DataSource\BpJsonFileDataSource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ShellFuellingProvider::class, function ($app) {
            return new ShellFuellingProvider(new ShellJsonFileDataSource());
        });

        $this->app->singleton(BpFuellingProvider::class, function ($app) {
            return new BpFuellingProvider(new BpJsonFileDataSource());
        });

        $this->app->singleton(LocationsService::class, function ($app) {
            return new LocationsService(
                ShellFuellingProvider::class,
                BpFuellingProvider::class,
                // Add more providers here in the future
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
