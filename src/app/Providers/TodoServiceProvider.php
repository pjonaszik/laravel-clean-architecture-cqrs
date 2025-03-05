<?php

namespace App\Providers;

use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Persistence\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    public $singletons = [
        TodoRepositoryInterface::class => TodoRepository::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
