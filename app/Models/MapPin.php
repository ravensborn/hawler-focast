<?php

namespace App\Models;

use App\Enums\MapPinType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapPin extends Model
{
    /** @use HasFactory<\Database\Factories\MapPinFactory> */
    use HasFactory;

    protected $fillable = [
        'icon',
        'latitude',
        'longitude',
        'type',
        'data',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => MapPinType::class,
            'data' => 'array',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * @param  Builder<MapPin>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where(function (Builder $query) {
            $query->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        });
    }
}
