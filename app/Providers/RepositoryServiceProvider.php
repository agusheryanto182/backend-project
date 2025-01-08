<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\DivisionRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\EmployeeRepository;
use App\Interfaces\EmployeeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DivisionRepositoryInterface::class, DivisionRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
