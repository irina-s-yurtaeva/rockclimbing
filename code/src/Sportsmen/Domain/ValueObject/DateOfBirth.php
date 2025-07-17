<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\ValueObject;

use DateTimeImmutable;
use InvalidArgumentException;

class DateOfBirth
{
    private DateTimeImmutable $birthdate;

    public function __construct(DateTimeImmutable $birthdate)
    {
        if ($birthdate > new DateTimeImmutable()) {
            throw new InvalidArgumentException('Дата рождения не может быть в будущем.');
        }

        $this->birthdate = $birthdate;
    }

    public function getBirthdate(): DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function isAdult(): bool
    {
        $today = new DateTimeImmutable();
        $age = $today->diff($this->birthdate)->y;

        return $age >= 18;
    }

    public function toString(): string
    {
        return $this->birthdate->format('Y-m-d');
    }

    public static function fromString(string $date): self
    {
        return new self(new \DateTimeImmutable($date));
    }
}
