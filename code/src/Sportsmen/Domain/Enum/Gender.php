<?php

declare(strict_types=1);

namespace App\Sportsmen\Domain\Enum;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';
}
