<?php

namespace App\Providers;

use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        TodoRepositoryInterface::class => TodoRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
