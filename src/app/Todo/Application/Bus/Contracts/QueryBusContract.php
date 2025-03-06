<?php

declare(strict_types=1);

namespace App\Todo\Application\Bus\Contracts;

use App\Todo\Application\Bus\Query\Query;

interface QueryBusContract
{
    public function ask(Query $query): mixed;

    public function register(array $map): void;
}
