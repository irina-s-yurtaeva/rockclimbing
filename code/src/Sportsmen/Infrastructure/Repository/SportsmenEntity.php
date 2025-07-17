<?php

namespace App\Sportsmen\Infrastructure\Repository;

use App\Sportsmen\Domain\ValueObject\Category;
use App\Sportsmen\Domain\ValueObject\Rank;
use Doctrine\ORM\Mapping as ORM;
use App\Sportsmen\Domain\Entity\Sportsmen;
use App\User\Infrastructure\Repository\UserEntity;

#[ORM\Entity]
#[ORM\Table(name: 'sportsman')]
#[ORM\UniqueConstraint(name: 'udx_sportsman_user_id', columns: ['user_id'])]
#[ORM\Index(name: 'idx_sportsman_category_code', columns: ['category_code'])]
#[ORM\Index(name: 'idx_sportsman_rank_code', columns: ['rank_code'])]
#[ORM\Index(name: 'idx_sportsman_school_id', columns: ['school_id'])]
class SportsmenEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $middleName = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $passportNumber = null;

    #[ORM\Column(type: 'string', length: 6, nullable: true, options: ['default' => 'male'])]
    private ?string $gender;

    #[ORM\Column(type: 'datetime_immutable', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $birthdate;

    #[ORM\ManyToOne(targetEntity: CategoryEntity::class)]
    #[ORM\JoinColumn(name: 'category_code', referencedColumnName: 'code', nullable: true)]
    private ?CategoryEntity $category = null;

    #[ORM\ManyToOne(targetEntity: RankEntity::class)]
    #[ORM\JoinColumn(name: 'rank_code', referencedColumnName: 'code', nullable: true)]
    private ?RankEntity $rank = null;

    #[ORM\ManyToOne(targetEntity: SchoolEntity::class, fetch: 'LAZY')]
    #[ORM\JoinColumn(name: 'school_id', referencedColumnName: 'id', nullable: true)]
    private ?SchoolEntity $school = null;
    private ?int $schoolId = null;

    #[ORM\ManyToOne(targetEntity: UserEntity::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', unique: true, nullable: true)]
    private ?UserEntity $UserEntity = null;
    private ?int $userEntityId = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
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

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getBirthdate(): \DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeImmutable $birthdate): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getCategory(): ?CategoryEntity
    {
        return $this->category;
    }

    public function setCategory(?CategoryEntity $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getRank(): ?RankEntity
    {
        return $this->rank;
    }

    public function setRank(?RankEntity $rank): self
    {
        $this->rank = $rank;
        return $this;
    }

    public function getSchoolId(): ?int
    {
        return $this->schoolId;
    }

    public function setSchoolId(?int $schoolId): self
    {
        $this->schoolId = $schoolId;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUser(): ?UserEntity
    {
        return $this->UserEntity;
    }

    public function setUser(?UserEntity $user): self
    {
        $this->UserEntity = $user;
        return $this;
    }

    public static function fromDomain(Sportsmen $sportsman): self
    {
        $entity = new self();
        $entity->firstName = $sportsman->getFirstName();
        $entity->lastName = $sportsman->getLastName();
        $entity->middleName = $sportsman->getMiddleName();
        $entity->passportNumber = $sportsman->getPassportNumber();
        $entity->gender = $sportsman->getGender();
        $entity->birthdate = $sportsman->getBirthdate();
        $entity->category = $sportsman->getCategory();
        $entity->rank = $sportsman->getRank();
        $entity->schoolId = $sportsman->getSchoolId();
        $entity->userEntityId = $sportsman->getUserId();

        return $entity;
    }

    public function toDomain(): Sportsmen
    {
        return Sportsmen::create(
            id: $this->id,
            firstName: $this->firstName,
            lastName: $this->lastName,
            middleName: $this->middleName,
            passportNumber: $this->passportNumber,
            gender: $this->gender,
            birthdate: $this->birthdate,
            categoryCode: $this->category->getCode(),
            rankCode: $this->rank-> getCode(),
            schoolId: $this->school?->getId(),
            userId: $this->userEntityId,
            createdAt: $this->getCreatedAt(),
            updatedAt: $this->getUpdatedAt(),
        );
    }
}
