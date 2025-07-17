<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\ValueObject;

final class SchoolId
{
    public function __construct(private int $value) {}

    public function getValue(): int
    {
        return $this->value;
    }

    public function equals(SchoolId $other): bool
    {
        return $this->value === $other->value;
    }
}
