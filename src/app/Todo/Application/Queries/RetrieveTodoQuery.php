<?php

declare(strict_types=1);

namespace App\Todo\Application\Queries;

use App\Todo\Application\Bus\Query\Query;
use App\Todo\Application\Data\RetrieveTodoData;

class RetrieveTodoQuery extends Query
{
    public function __construct(
        readonly public RetrieveTodoData $query,
    ) {
    }
}
