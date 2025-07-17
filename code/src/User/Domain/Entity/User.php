<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

class User
{
    public function __construct(
        private int $id,
        private string $login,
        private string $email,
        private string $password,
    ) {}

    public function getId(): int { return $this->id; }
    public function getLogin(): string { return $this->login; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }

    public static function create(
        string $username,
        string $email,
        string $password,
    ): self {
        return new self(
            id: 0,
            login: $username,
            email: $email,
            password: $password,
        );
    }
}
