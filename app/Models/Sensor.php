<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function sensorParameters(): HasMany
    {
        return $this->hasMany(SensorParameter::class);
    }

    public function sensorDevices(): HasMany
    {
        return $this->hasMany(SensorDevice::class);
    }
}
