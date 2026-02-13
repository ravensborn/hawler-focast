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

        $airQualitySensor = Sensor::create(['name' => 'Air Quality Sensor']);

        $airQualityParams = [
            ['name' => 'Temperature', 'platform_parameter_id' => 1, 'unit' => '°C', 'icon' => 'thermometer'],
            ['name' => 'Humidity', 'platform_parameter_id' => 2, 'unit' => '%', 'icon' => 'droplet'],
            ['name' => 'CO', 'platform_parameter_id' => 3, 'unit' => 'ppm', 'icon' => 'cloud'],
            ['name' => 'SO2', 'platform_parameter_id' => 4, 'unit' => 'ppb', 'icon' => 'cloud'],
            ['name' => 'NO2', 'platform_parameter_id' => 5, 'unit' => 'ppb', 'icon' => 'cloud'],
            ['name' => 'O3', 'platform_parameter_id' => 6, 'unit' => 'ppb', 'icon' => 'cloud'],
            ['name' => 'PM2.5', 'platform_parameter_id' => 7, 'unit' => 'µg/m³', 'icon' => 'gauge'],
            ['name' => 'PM10', 'platform_parameter_id' => 8, 'unit' => 'µg/m³', 'icon' => 'gauge'],
        ];

        foreach ($airQualityParams as $param) {
            SensorParameter::create([
                ...$param,
                'sensor_id' => $airQualitySensor->id,
            ]);
        }

        SensorDevice::create([
            'name' => ['en' => 'Air Quality Station 1', 'ar' => 'محطة جودة الهواء 1', 'ku' => 'وێستگەی کوالیتی هەوا 1'],
            'sensor_id' => $airQualitySensor->id,
            'sensor_device_group_id' => $group->id,
            'platform_device_id' => 'air-quality-1',
        ]);

        $airQualitySensor2 = Sensor::create(['name' => 'Air Quality Sensor 2']);

        $airQuality2Params = [
            ['name' => 'CO2', 'platform_parameter_id' => 9, 'unit' => 'ppm', 'icon' => 'cloud'],
            ['name' => 'CH4', 'platform_parameter_id' => 10, 'unit' => 'ppm', 'icon' => 'cloud'],
            ['name' => 'PM100', 'platform_parameter_id' => 11, 'unit' => 'µg/m³', 'icon' => 'gauge'],
        ];

        foreach ($airQuality2Params as $param) {
            SensorParameter::create([
                ...$param,
                'sensor_id' => $airQualitySensor2->id,
            ]);
        }

        SensorDevice::create([
            'name' => ['en' => 'Air Quality Station 2', 'ar' => 'محطة جودة الهواء 2', 'ku' => 'وێستگەی کوالیتی هەوا 2'],
            'sensor_id' => $airQualitySensor2->id,
            'sensor_device_group_id' => $group->id,
            'platform_device_id' => 'air-quality-2',
        ]);

        $rainSensor = Sensor::create(['name' => 'Rain Meter Sensor']);

        SensorParameter::create([
            'name' => 'Total Rain',
            'sensor_id' => $rainSensor->id,
            'platform_parameter_id' => 12,
            'unit' => 'mm',
            'icon' => 'droplet',
        ]);

        SensorDevice::create([
            'name' => ['en' => 'Rain Meter Station', 'ar' => 'محطة قياس المطر', 'ku' => 'وێستگەی پێوانەی باران'],
            'sensor_id' => $rainSensor->id,
            'sensor_device_group_id' => $group->id,
            'platform_device_id' => 'rain-meter-1',
        ]);
    }
}
