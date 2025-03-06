<?php

namespace App\Todo\Application\Contracts;

use App\Todo\Application\Data\CreateTodoData;

interface TodoServiceContract
{
    public function create(CreateTodoData $createTodoData): string;
}
