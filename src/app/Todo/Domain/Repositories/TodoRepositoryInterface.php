<?php

declare(strict_types=1);

namespace App\Todo\Domain\Repositories;

use App\Todo\Domain\Entities\Todo;

interface TodoRepositoryInterface
{
    /**
     * @return Todo[]
     */
    public function getAll(): array;

    public function findById(string $id): array;

    public function save(Todo $todo): array;

    public function delete(string $id): void;
}
