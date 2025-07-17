<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Repository;

use App\Sportsmen\Domain\Entity\School;

interface SchoolRepository
{
    public function save(School $school): void;
    public function findById(int $id): ?School;
}
