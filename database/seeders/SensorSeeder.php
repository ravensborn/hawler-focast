<?php

namespace Database\Seeders;

use App\Models\Sensor;
use App\Models\SensorDevice;
use App\Models\SensorDeviceGroup;
use App\Models\SensorParameter;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = SensorDeviceGroup::create([
            'name' => [
                'en' => 'Air Quality',
                'ar' => 'جودة الهواء',
                'ku' => 'کوالیتی هەوا',
            ],
        ]);

        $sensor = Sensor::create([
            'name' => 'Air Quality',
        ]);

        SensorParameter::create([
            'name' => 'Temperature',
            'sensor_id' => $sensor->id,
            'platform_parameter_id' => 1,
            'unit' => '°C',
            'icon' => 'thermometer',
        ]);

        SensorParameter::create([
            'name' => 'Humidity',
            'sensor_id' => $sensor->id,
            'platform_parameter_id' => 2,
            'unit' => '%',
            'icon' => 'droplet',
        ]);

        $stations = [
            ['en' => 'Station 1', 'ar' => 'المحطة 1', 'ku' => 'وێستگە 1'],
            ['en' => 'Station 2', 'ar' => 'المحطة 2', 'ku' => 'وێستگە 2'],
            ['en' => 'Station 3', 'ar' => 'المحطة 3', 'ku' => 'وێستگە 3'],
        ];

        foreach ($stations as $index => $name) {
            SensorDevice::create([
                'name' => $name,
                'sensor_id' => $sensor->id,
                'sensor_device_group_id' => $group->id,
                'platform_device_id' => 'station-' . ($index + 1),
            ]);
        }
    }
}
