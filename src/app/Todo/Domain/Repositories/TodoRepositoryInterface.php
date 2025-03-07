<?php

declare(strict_types=1);

namespace App\Todo\Domain\Repositories;

use App\Todo\Application\Data\CreateTodoData;
use App\Todo\Domain\Entities\Todo;

interface TodoRepositoryInterface
{
    public function create(CreateTodoData $createTodoData): string;
    public function retrieve(string $id, array $criteria): ?Todo;
    public function update(string $id, array $update): string;

    /**
     * @param array|null $criteria
     * @return Todo[]|[]
     */
    public function retrieveAll(?array $criteria): array;
}
