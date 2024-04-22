<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CoachRepositoryInterface;
use App\Contracts\LocationRepositoryInterface;
use App\Repositories\CoachRepository;
use App\Repositories\LocationRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CoachRepositoryInterface::class,
            CoachRepository::class
        );

        $this->app->bind(
            LocationRepositoryInterface::class,
            LocationRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
