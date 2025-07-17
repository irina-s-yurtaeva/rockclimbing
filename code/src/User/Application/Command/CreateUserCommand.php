<?php

declare(strict_types=1);

namespace App\User\Application\Command;

class CreateUserCommand
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {}
}
