<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapPinResource;
use App\Models\MapPin;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MapPinController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return MapPinResource::collection(
            MapPin::query()
                ->with('sensorDeviceGroup.sensorDevices.latestTelemetries.sensorParameter')
                ->active()
                ->get()
        );
    }
}
