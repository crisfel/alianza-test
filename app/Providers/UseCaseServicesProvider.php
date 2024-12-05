<?php

namespace App\Providers;

use App\UseCases\Contracts\Employee\StoreEmployeeUseCaseInterface;
use App\UseCases\Employee\StoreEmployeeUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected array $classes = [
        StoreEmployeeUseCaseInterface::class => StoreEmployeeUseCase::class
    ];


    public function register(): void
    {
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
