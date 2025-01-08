<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\DivisionRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\DivisionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DivisionRepositoryInterface::class, DivisionRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
