<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

final class HashedPassword
{
    public function __construct(
        private readonly string $hash
    ) {
        if ('' === trim($this->hash)) {
            throw new \InvalidArgumentException('Hash must not be empty.');
        }
    }

    public function __toString(): string
    {
        return $this->hash;
    }

    public function equals(self $other): bool
    {
        return $this->hash === (string) $other;
    }
}
