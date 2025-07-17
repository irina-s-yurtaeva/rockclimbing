<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Entity;

class Category
{
    private string $code;
    private string $title;

    public function __construct(string $code, string $title)
    {
        $this->code = $code;
        $this->title = $title;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
