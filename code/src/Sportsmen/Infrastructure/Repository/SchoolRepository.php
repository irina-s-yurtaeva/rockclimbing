<?php

declare(strict_types=1);

namespace App\Sportsmen\Infrastructure\Repository;

use App\Sportsmen\Domain\Entity\School;

class SchoolRepository implements \App\Sportsmen\Domain\Repository\SchoolRepository
{

    public function save(School $school): void
    {
        // TODO: Implement save() method.
    }

    public function findById(int $id): ?School
    {
        // TODO: Implement findById() method.
    }
}
