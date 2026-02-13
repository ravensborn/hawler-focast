<?php

namespace App\Enums;

enum AlertType: string
{
    case Info = 'info';
    case Warning = 'warning';
    case Danger = 'danger';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function exists(string $value): bool
    {
        return in_array($value, self::values());
    }
}
