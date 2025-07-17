<?php

declare(strict_types=1);

namespace App\Sportsmen\Infrastructure\Repository;

use App\Sportsmen\Domain\Entity\Rank;
use \App\Sportsmen\Domain;
use Doctrine\ORM\EntityManagerInterface;

class RankRepository implements Domain\Repository\RankRepository
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {}

    public function findByCode(string $code): ?Rank
    {
        $orm = $this->em->getRepository(RankEntity::class)
            ->findOneBy(['code' => $code]);

        return $orm ? new Rank($orm->getCode(), $orm->getTitle()) : null;
    }

    public function getOrmByRank(Rank $rank): ?RankEntity
    {
        return $this->em->getRepository(RankEntity::class)
            ->findOneBy(['code' => $rank->getCode()]);
    }

    public function save(Rank $rank): void
    {
        $orm = new RankEntity();
        $orm->setCode($rank->getCode());

        $this->em->persist($orm);
        $this->em->flush();
    }
}
