<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\ValueObject;

use App\Sportsmen\Domain\Enum;

class Gender
{
    private Enum\Gender $value;

    public function __construct(string $gender)
    {
        if (!Enum\Gender::tryFrom($gender)) {
            throw new \InvalidArgumentException('Invalid gender value');
        }

        $this->value = Enum\Gender::from($gender);
    }

    public function getValue(): Enum\Gender
    {
        return $this->value;
    }

    public function equals(Gender $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value->value;
    }
}
