<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\ValueObject;

class Category
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function equals(Category $category): bool
    {
        return $this->code === $category->getCode();
    }
}
