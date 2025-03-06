<?php

declare(strict_types=1);

namespace App\Todo\Application\Bus\Query;

use App\Todo\Application\Bus\Contracts\QueryBusContract;
use Illuminate\Bus\Dispatcher;

class QueryBus implements QueryBusContract
{
    public function __construct(
        protected Dispatcher $bus,
    ) {
    }

    public function ask(Query $query): mixed
    {
        return $this->bus->dispatch($query);
    }

    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
