<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Todo\Application\Services\TodoService;
use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Domain\ValueObjects\DueDate;
use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskTitle;
use Illuminate\Support\Str;
use Mockery;

it('creates a new todo', function () {
    $mockRepository = Mockery::mock(TodoRepositoryInterface::class);
    $id = Str::ulid()->toString();
    $taskTitle = new TaskTitle("Test Task");
    $taskDescription = new TaskDescription("Test task description");
    $dueDate = new DueDate("2030-01-01");
    $completed = fake()->boolean();

    $mockRepository->shouldReceive('save')->once()->andReturn(
        new Todo($id, $taskTitle, $taskDescription, $dueDate)->toArray()
    );

    $service = new TodoService($mockRepository);
    $todo = $service->create("Test Task", "Test task description", "2030-01-01");

    expect($todo['title'])->toBe("Test Task");
    expect($todo['description'])->toBe("Test task description");
    expect($todo['completed'])->toBeBool();
});
