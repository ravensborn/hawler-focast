<?php

namespace Database\Seeders;

use App\Enums\MapPinType;
use App\Models\MapPin;
use App\Models\SensorDevice;
use Illuminate\Database\Seeder;

class MapPinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = SensorDevice::query()
            ->with('sensor.sensorParameters')
            ->get()
            ->keyBy('platform_device_id');

        $stations = [
            ['name' => 'Erbil Citadel', 'lat' => 36.1901, 'lng' => 44.0089, 'device' => 'station-1'],
            ['name' => 'Ankawa', 'lat' => 36.2290, 'lng' => 44.0163, 'device' => 'station-2'],
            ['name' => 'Ainkawa Park', 'lat' => 36.2215, 'lng' => 44.0250, 'device' => 'station-3'],
            ['name' => 'Sami Abdulrahman Park', 'lat' => 36.1980, 'lng' => 43.9930, 'device' => null],
            ['name' => 'Erbil International Airport', 'lat' => 36.2376, 'lng' => 43.9632, 'device' => null],
        ];

        foreach ($stations as $station) {
            $data = [
                'stationName' => $station['name'] . ' Weather Station',
                'status' => 'active',
            ];

            $device = $station['device'] ? $devices->get($station['device']) : null;

            if ($device) {
                $data['deviceId'] = $device->id;
                $data['deviceName'] = $device->getTranslations('name');
                $data['parameters'] = $device->sensor->sensorParameters->map(fn ($param) => [
                    'name' => $param->name,
                    'unit' => $param->unit,
                    'icon' => $param->icon,
                    'value' => fake()->randomFloat(2, 0, 100),
                ])->toArray();
            } else {
                $data['lastReading'] = rand(-5, 45) + rand(0, 9) / 10;
            }

            MapPin::factory()->weatherStation()->create([
                'latitude' => $station['lat'],
                'longitude' => $station['lng'],
                'data' => $data,
            ]);
        }

        $alerts = [
            ['name' => 'Erbil Bazaar', 'lat' => 36.1870, 'lng' => 44.0120, 'severity' => 'high', 'message' => 'Extreme heat warning'],
            ['name' => 'Naz City', 'lat' => 36.2100, 'lng' => 44.0350, 'severity' => 'medium', 'message' => 'Strong winds advisory'],
            ['name' => 'Shanadar', 'lat' => 36.1950, 'lng' => 44.0200, 'severity' => 'low', 'message' => 'Light dust forecast'],
        ];

        foreach ($alerts as $alert) {
            MapPin::factory()->alert()->create([
                'latitude' => $alert['lat'],
                'longitude' => $alert['lng'],
                'data' => [
                    'severity' => $alert['severity'],
                    'message' => $alert['message'],
                ],
                'expires_at' => now()->addDays(rand(1, 7)),
            ]);
        }
    }
}
