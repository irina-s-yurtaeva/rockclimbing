<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\ValueObject;

class UserId
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
