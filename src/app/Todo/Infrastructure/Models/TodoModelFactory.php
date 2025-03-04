<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<TodoModel>
 */
class TodoModelFactory extends Factory
{
    protected $model = TodoModel::class;

    /**
     * @throws \DateMalformedStringException
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(10, true),
            'description' => $this->faker->words(100, true),
            'due_date' => new \DateTimeImmutable(now()->addMinutes(10)->toString())->format(DateTimeInterface::RFC3339),
            'completed' => $this->faker->boolean(),
        ];
    }
}
