<?php

declare(strict_types=1);

namespace App\Todo\Domain\ValueObjects;

use InvalidArgumentException;

final class DueDate
{
    public function __construct(
        public string $value {
            get
    {
        return $this->value;
    }
        set(string $value) {
            if (new \DateTimeImmutable($value) < new \DateTimeImmutable()) {
                // Validation example.
                throw new InvalidArgumentException('Due date must be in the future.');
            }
            $this->value = $value;
        }
        }
    )
    {}
}
