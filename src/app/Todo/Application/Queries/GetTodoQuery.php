<?php

declare(strict_types=1);

namespace App\Todo\Application\Queries;

use App\Todo\Application\Bus\Query\Query;
use App\Todo\Application\Data\GetTodoQueryData;

class GetTodoQuery extends Query
{
    public function __construct(
        readonly public GetTodoQueryData $getTodoQueryData,
    ) {
    }
}
