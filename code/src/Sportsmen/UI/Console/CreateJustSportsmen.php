<?php

declare(strict_types=1);

namespace App\Sportsmen\UI\Console;

use App\Sportsmen\Application\Command\Handler\CreateSportsmenHandler;
use App\Sportsmen\Application\Command\CreateSportsmenCommand;
use App\Sportsmen\Domain\Enum;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:create-just-sportsmen',
    description: 'Creates a basic sportsmen profile.'
)]
class CreateJustSportsmen extends Command
{
    public static $defaultName = 'app:create-just-sportsmen';

    public function __construct(
        private CreateSportsmenHandler $createSportsmenHandler
    )
    {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Создает карточку спортсмена с минимальным набором данных')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Мы создаем карточку спортсмена пока без привязки к авторизации');

        $io = new SymfonyStyle($input, $output);

        $firstName = $io->ask('Введите имя');
        $lastName = $io->ask('Введите фамилию');

        $question = new Question('Пол мужской? (да/нет)', 'да');
        $genderAnswer = $io->askQuestion($question);

        $birthDate = $io->ask('Введите дату рождения в формате YYYY-MM-DD', null, function ($date) {
            $isFormatValid = filter_var($date, FILTER_VALIDATE_REGEXP, [
                'options' => [
                    'regexp' => '/^\d{4}-\d{2}-\d{2}$/'
                ]
            ]);

            if ($isFormatValid === false) {
                throw new \RuntimeException('Неверный формат даты. Используйте YYYY-MM-DD.');
            } else {
                [$year, $month, $day] = explode('-', $date);

                if (!checkdate((int)$month, (int)$day, (int)$year)) {
                    throw new \RuntimeException('Дата не существует');
                }
            }

            return $date;
        });

        $this->createSportsmenHandler->__invoke(
            new CreateSportsmenCommand(
                firstName: $firstName,
                lastName: $lastName,
                gender: $genderAnswer === 'да' ? Enum\Gender::Male->value : Enum\Gender::Female->value,
                birthDateYmd: $birthDate,
            )
        );

        $io->success('Спортсмен успешно создан.');
        return Command::SUCCESS;
    }
}
