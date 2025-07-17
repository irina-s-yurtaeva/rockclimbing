<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Repository;

use App\Sportsmen\Domain\Entity\Category;

interface CategoryRepository
{
    public function save(Category $category): void;
    public function findByCode(string $code): ?Category;
}
