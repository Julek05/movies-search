<?php

declare(strict_types=1);

namespace App\Enum;

enum SearchType: string
{
    case RANDOM = 'random';
    case CHARACTER = 'character';
    case WORD_COUNT = 'word_count';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
