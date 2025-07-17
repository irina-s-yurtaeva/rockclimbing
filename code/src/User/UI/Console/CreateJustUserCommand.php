<?php

declare(strict_types=1);

namespace App\User\UI\Console;

use App\User\Application\Command\Handler\CreateUserHandler;
use App\User\Application\Command\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-just-user',
    description: 'Creates a simple user.'
)]
class CreateJustUserCommand extends Command
{
    public static $defaultName = 'app:create-just-user';

    public function __construct(
        private CreateUserHandler $createUserHandler
    )
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Создает простого пользователя с паролем и логином')
            ->setHelp('
                Эта команда позволяет создать простого пользователя.
                Например: php bin/console app:create-just-user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Мы создаем пользователя с логином и паролем');

        $io = new SymfonyStyle($input, $output);

        $username = $io->ask('Введите логин');
        $email = $io->ask('Введите email', null, function ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException('Неверный формат email.');
            }
            return $email;
        });

        $password = $io->askHidden('Введите пароль', function ($password) {
            if (strlen($password) < 6) {
                throw new \RuntimeException('Пароль должен быть не короче 6 символов.');
            }
            return $password;
        });

        $this->createUserHandler->__invoke(
            new CreateUserCommand(
                username: $username,
                email: $email,
                password: $password
            )
        );

        $io->success('Пользователь успешно создан.');
        return Command::SUCCESS;
    }
}
