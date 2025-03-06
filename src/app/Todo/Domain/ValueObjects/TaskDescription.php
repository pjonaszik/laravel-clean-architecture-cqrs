<?php

declare(strict_types=1);

namespace App\Todo\Domain\ValueObjects;

class TaskDescription
{
    public function __construct(
        public string $value {
            get => $this->value;
        set(string $value) {
            if (empty($value)) {
                throw new \InvalidArgumentException("Task description cannot be empty.");
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
