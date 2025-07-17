<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use InvalidArgumentException;

class EmailAddress
{
    private string $email;

    public function __construct(string $email)
    {
        $email = trim(strtolower($email));
        $this->validate($email);
        $this->email = $email;
    }

    private function validate(string $email): void
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Email cannot be empty.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email address format.');
        }

        if (strpos($email, ' ') !== false) {
            throw new InvalidArgumentException('Email cannot contain spaces.');
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
