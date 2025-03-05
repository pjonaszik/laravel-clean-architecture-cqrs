<?php

declare(strict_types=1);

namespace App\Todo\Domain\Repositories;

use App\Todo\Domain\Entities\Todo;

interface TodoRepositoryInterface
{
    public function create(Todo $todo): Todo;
    public function retrieve(string $id, array $criteria): ?Todo;
}
