<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Repository;

use App\Sportsmen\Domain\Entity\Sportsmen;

interface SportsmenRepository
{
    public function save(Sportsmen $sportsman): void;
    public function findById(int $id): ?Sportsmen;
    public function isByPassportNumber(string $passportNumber): bool;
    public function isByUserId(int $userId): bool;
}
