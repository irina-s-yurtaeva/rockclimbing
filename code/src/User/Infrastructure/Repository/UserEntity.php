<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use Doctrine\ORM\Mapping as ORM;
use App\User\Domain\Entity\User;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class UserEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $login;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private string $hashedPassword;

    public static function fromDomain(User $user): self
    {
        $entity = new self();
        $entity->id = $user->getId();
        $entity->login = $user->getLogin();
        $entity->email = $user->getEmail();
        $entity->hashedPassword = $user->getPassword();

        return $entity;
    }

    public function toDomain(): User
    {
        return new User(
            $this->id,
            $this->login,
            $this->email,
            $this->hashedPassword,
        );
    }
}
