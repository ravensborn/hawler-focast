<?php

namespace App\Models;

use App\Enums\NotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'description',
        'type',
    ];

    protected function casts(): array
    {
        return [
            'type' => NotificationType::class,
        ];
    }
}
