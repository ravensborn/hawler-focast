<?php

namespace App\Enums;

enum Language: string
{
    case English = 'en';
    case Arabic = 'ar';
    case Kurdish = 'ku';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function exists(string $value): bool
    {
        return in_array($value, self::values());
    }
}
