<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Service;

use App\User\Application\Service\PasswordHasher;

class NativePasswordHasher implements PasswordHasher
{
    public function hash(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}
