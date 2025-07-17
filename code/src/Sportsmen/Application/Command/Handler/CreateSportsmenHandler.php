<?php

declare(strict_types=1);

namespace App\Sportsmen\Application\Command\Handler;

use App\Sportsmen\Application\Command\CreateSportsmenCommand;
use App\Sportsmen\Domain\Entity\Sportsmen;
use App\Sportsmen\Domain\Repository\CategoryRepository;
use App\Sportsmen\Domain\Repository\RankRepository;
use App\Sportsmen\Domain\Repository\SportsmenRepository;
use App\Sportsmen\Domain\Repository\SchoolRepository;

class CreateSportsmenHandler
{
    private SportsmenRepository $sportsmanRepository;
    private CategoryRepository $categoryRepository;
    private RankRepository $rankRepository;
    private SchoolRepository $schoolRepository;

    public function __construct(
        SportsmenRepository $sportsmanRepository,
        CategoryRepository $categoryRepository,
        RankRepository $rankRepository,
        SchoolRepository $schoolRepository
    ) {
        $this->sportsmanRepository = $sportsmanRepository;
        $this->categoryRepository = $categoryRepository;
        $this->rankRepository = $rankRepository;
        $this->schoolRepository = $schoolRepository;
    }

    public function __invoke(CreateSportsmenCommand $command): void
    {
        $category = null;
        if ($command->categoryCode) {
            $category = $this->categoryRepository->findByCode($command->categoryCode);
            if (!$category) {
                throw new \InvalidArgumentException("Категория не найдена.");
            }
        }

        $rank = null;
        if ($command->rankCode) {
            $rank = $this->rankRepository->findByCode($command->rankCode);
            if (!$rank) {
                throw new \InvalidArgumentException("Разряд не найден.");
            }
        }

        $school = null;
        if ($command->schoolId) {
            $school = $this->schoolRepository->findById($command->schoolId);
            if (!$school) {
                throw new \InvalidArgumentException("Школа не найдена.");
            }
        }

        if ($command->passportNumber && $this->sportsmanRepository->isByPassportNumber($command->passportNumber)) {
            throw new \InvalidArgumentException("Спортсмен с таким паспортом уже существует.");
        }

        if ($command->userId && $this->sportsmanRepository->isByUserId($command->userId)) {
            throw new \InvalidArgumentException("Спортсмен с такими авторизациоными данными уже существует.");
        }

        $sportsman = Sportsmen::createBrief(
            firstName: $command->firstName,
            lastName: $command->lastName,
            gender: $command->gender,
            birthdate: \DateTimeImmutable::createFromFormat('Y-m-d', $command->birthDateYmd),
        );

        $this->sportsmanRepository->save($sportsman);
    }
}
