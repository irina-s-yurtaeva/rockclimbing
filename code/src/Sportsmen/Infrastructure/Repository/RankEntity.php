<?php

declare(strict_types=1);

namespace App\Sportsmen\Infrastructure\Repository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'rank')]
class RankEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 2)]
    private string $code;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
}
