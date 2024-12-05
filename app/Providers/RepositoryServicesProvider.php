<?php

namespace App\Providers;

use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\EmployeePosition\EmployeePositionRepository;
use App\Repositories\Position\PositionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    protected array $classes = [
        EmployeeRepositoryInterface::class => EmployeeRepository::class,
        PositionRepositoryInterface::class => PositionRepository::class,
        EmployeePositionRepositoryInterface::class => EmployeePositionRepository::class
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
