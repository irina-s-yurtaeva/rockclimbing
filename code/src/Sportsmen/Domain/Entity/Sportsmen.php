<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Entity;

use App\Sportsmen\Domain\ValueObject\Category;
use App\Sportsmen\Domain\ValueObject\Rank;
use App\Sportsmen\Domain\ValueObject\Gender;
use App\Sportsmen\Domain\ValueObject\SchoolId;
use App\Sportsmen\Domain\ValueObject\UserId;
use App\Sportsmen\Domain\ValueObject\DateOfBirth;
use DateTimeInterface;

class Sportsmen
{
    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
        private ?string $middleName = null,
        private ?string $passportNumber = null,
        private Gender $gender,
        private DateOfBirth $birthdate,
        private ?Category $category = null,
        private ?Rank $rank = null,
        private ?SchoolId $schoolId = null,
        private ?UserId $userId = null,
        private \DateTimeImmutable $createdAt = new \DateTimeImmutable(),
        private \DateTimeImmutable $updatedAt = new \DateTimeImmutable(),
    ) {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getPassportNumber(): ?string
    {
        return $this->passportNumber;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function getBirthdate(): \DateTimeImmutable
    {
        return $this->birthdate->getBirthdate();
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getRank(): ?Rank
    {
        return $this->rank;
    }

    public function getSchoolId(): ?SchoolId
    {
        return $this->schoolId;
    }

    public function getUserId(): ?UserId
    {
        return $this->userId;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public static function createBrief(
        string $firstName,
        string $lastName,
        string $gender,
        \DateTimeImmutable $birthdate,
        ?string $passportNumber = null,
    ): self {
         return new self(
             id: 0,
             firstName: $firstName,
             lastName: $lastName,
             middleName: null,
             passportNumber: $passportNumber,
             gender: new Gender($gender),
             birthdate: new DateOfBirth($birthdate),
         );
    }

    public static function create(
        int $id,
        string $firstName,
        string $lastName,
        ?string $middleName = null,
        ?string $passportNumber = null,
        string $gender,
        \DateTimeImmutable $birthdate,
        ?string $categoryCode = null,
        ?string $rankCode = null,
        ?int $schoolId = null,
        ?int $userId = null,
        \DateTimeImmutable $createdAt = new \DateTimeImmutable(),
        \DateTimeImmutable $updatedAt = new \DateTimeImmutable(),
    ): self {
        return new self(
            $id,
            $firstName,
            $lastName,
            $middleName,
            $passportNumber,
            new Gender($gender),
            new DateOfBirth($birthdate),
            new Category($categoryCode),
            new Rank($rankCode),
            $schoolId ? new SchoolId($schoolId) : null,
            $userId ? new UserId($userId) : null,
            $createdAt,
            $updatedAt,
        );
    }
}
