<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SensorDeviceGroupResource;
use App\Models\SensorDeviceGroup;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SensorDeviceGroupController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SensorDeviceGroupResource::collection(
            SensorDeviceGroup::query()
                ->with('sensorDevices.latestTelemetries.sensorParameter')
                ->get()
        );
    }
}
