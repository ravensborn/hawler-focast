<?php

namespace App\Enums;

enum SensorParameterUnit: string
{
    case Celsius = '°C';
    case RelativeHumidity = '%';
    case Kilograms = 'kg';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function exists(string $value): bool
    {
        return in_array($value, self::values());
    }
}
