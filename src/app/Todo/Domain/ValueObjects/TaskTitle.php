<?php

declare(strict_types=1);

namespace App\Todo\Domain\ValueObjects;

use InvalidArgumentException;

final class TaskTitle
{
    public function __construct(public string $value {
        get => $this->value;
        set(string $value) {
            if (empty($value)) {
                throw new InvalidArgumentException('Task title must be a string');
            }
            $this->value = $value;
        }
        })
    {
    }
}
