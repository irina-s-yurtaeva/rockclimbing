<?php

declare(strict_types=1);

namespace App\Sportsmen\Application\Command;

final class CreateSportsmenCommand
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $gender,
        public readonly string $birthDateYmd,
        public readonly ?string $passportNumber = null,
        public readonly ?string $categoryCode = null,
        public readonly ?string $rankCode = null,
        public readonly ?int $schoolId = null,
        public readonly ?int $userId = null,
    ) {}
}
