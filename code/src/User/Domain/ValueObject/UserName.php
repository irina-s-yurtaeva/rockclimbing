<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use InvalidArgumentException;

class UserName
{
    private string $username;

    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 20;
    private const REGEX_PATTERN = '/^[a-zA-Z0-9_]+$/';

    public function __construct(string $username)
    {
        $this->validate($username);
        $this->username = $username;
    }

    private function validate(string $username): void
    {
        $length = strlen($username);

        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('Username must be between %d and %d characters.', self::MIN_LENGTH, self::MAX_LENGTH)
            );
        }

        if (!preg_match(self::REGEX_PATTERN, $username)) {
            throw new InvalidArgumentException('Username can only contain letters, numbers, and underscores.');
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
