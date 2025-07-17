<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Repository;

use App\Sportsmen\Domain\Entity\Rank;

interface RankRepository
{
    public function save(Rank $rank): void;
    public function findByCode(string $code): ?Rank;
}
