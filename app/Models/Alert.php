<?php

namespace App\Models;

use App\Enums\AlertType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Alert extends Model
{
    use HasFactory;
    use HasTranslations;


    protected $fillable = [
        'icon',
        'title',
        'description',
        'type',
    ];

    public array $translatable = ['title', 'description'];


    protected function casts(): array
    {
        return [
            'type' => AlertType::class,
        ];
    }
}
