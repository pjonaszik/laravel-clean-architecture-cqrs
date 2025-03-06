<?php

namespace App\Providers;

use App\Todo\Application\Bus\Command\CommandBus;
use App\Todo\Application\Bus\Contracts\CommandBusContract;
use App\Todo\Application\Bus\Contracts\QueryBusContract;
use App\Todo\Application\Bus\Query\QueryBus;
use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Handlers\CreateTodoHandler;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        TodoRepositoryInterface::class => TodoRepository::class,
        CommandBusContract::class => CommandBus::class,
        QueryBusContract::class => QueryBus::class,
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
        $this->registerCommandHandlers();
        $this->registerQueryHandlers();
    }

    protected function registerCommandHandlers(): void
    {
        $this->app->make(CommandBusContract::class)->register([
           CreateTodoCommand::class => CreateTodoHandler::class
        ]);
    }
    protected function registerQueryHandlers(): void
    {
        //        $queryBus = $this->app->make(QueryBusContract::class);
        //        $this->app->bind(QueryBusContract::class, $queryBus);
    }
}
