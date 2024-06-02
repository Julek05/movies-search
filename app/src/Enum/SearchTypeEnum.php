<?php

declare(strict_types=1);

namespace App\Enum;

enum SearchTypeEnum: string
{
    case RANDOM = 'RANDOM';
    case CHARACTER = 'CHARACTER';
    case WORD_COUNT = 'WORD_COUNT';
}
