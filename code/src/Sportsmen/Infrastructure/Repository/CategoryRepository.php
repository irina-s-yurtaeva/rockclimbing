<?php

declare(strict_types=1);

namespace App\Sportsmen\Infrastructure\Repository;

use App\Sportsmen\Domain\Entity\Category;

class CategoryRepository implements \App\Sportsmen\Domain\Repository\CategoryRepository
{

    public function save(Category $category): void
    {
        // TODO: Implement save() method.
    }

    public function findByCode(string $code): ?Category
    {
        // TODO: Implement findByCode() method.
    }
}
