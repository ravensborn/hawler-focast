<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class SensorDeviceGroup extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
    ];

    public array $translatable = ['name'];

    public function sensorDevices(): HasMany
    {
        return $this->hasMany(SensorDevice::class);
    }
}
