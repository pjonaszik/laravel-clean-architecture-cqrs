<?php

declare(strict_types=1);

namespace App\Todo\Domain\ValueObjects;

class TaskDueDate
{
    public function __construct(
        public string $value {
            get => $this->value;
        set(string $value) {
            if (!(new \DateTimeImmutable($value))) {
                throw new \InvalidArgumentException("Invalid due date.");
            }
            $this->value = $value;
        }
        }
    )
    {}

    public static function fromValue(string $value): self
    {
        return new self($value);
    }
}
