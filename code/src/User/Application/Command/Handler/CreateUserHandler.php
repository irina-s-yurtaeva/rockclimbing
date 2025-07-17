<?php

declare(strict_types=1);

namespace App\User\Application\Command\Handler;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Application\Command\CreateUserCommand;
use App\User\Application\Service\PasswordHasher;

//use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//#[AsMessageHandler]
class CreateUserHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordHasher $passwordHasher,
    ) {}

    public function __invoke(CreateUserCommand $command): void
    {
        $hashedPassword = $this->passwordHasher->hash($command->password);

        $user = User::create(
            username: $command->username,
            email: $command->email,
            password: $hashedPassword,
        );

        $this->userRepository->save($user);
    }
}
