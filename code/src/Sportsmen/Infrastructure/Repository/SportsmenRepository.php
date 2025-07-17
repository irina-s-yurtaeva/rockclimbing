<?php

declare(strict_types=1);

namespace App\Sportsmen\Infrastructure\Repository;

use App\Sportsmen\Domain\Entity\Sportsmen;
use Doctrine\ORM\EntityManagerInterface;

class SportsmenRepository implements \App\Sportsmen\Domain\Repository\SportsmenRepository
{
    public function __construct(private EntityManagerInterface $em) {}

    public function save(Sportsmen $sportsman): void
    {
        $entity = SportsmenEntity::fromDomain($sportsman);
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function findById(int $id): ?Sportsmen
    {
        $entity = $this->em->getRepository(SportsmenEntity::class)->find($id);

        return $entity?->toDomain();
    }

    public function isByPassportNumber(string $passportNumber): bool
    {
        return $this->em->getRepository(SportsmenEntity::class)
            ->findBy(['passportNumber' => $passportNumber], null, 1) !== null
        ;
    }

    public function isByUserId(int $userId): bool
    {
        return $this->em->getRepository(SportsmenEntity::class)
                ->findOneBy(['userID' => $userId]) !== null
            ;
    }
}
