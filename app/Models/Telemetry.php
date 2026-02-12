<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Telemetry extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_device_id',
        'sensor_parameter_id',
        'value',
    ];

    public function sensorDevice(): BelongsTo
    {
        return $this->belongsTo(SensorDevice::class);
    }

    public function sensorParameter(): BelongsTo
    {
        return $this->belongsTo(SensorParameter::class);
    }
}
