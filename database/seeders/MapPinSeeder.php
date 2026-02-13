<?php

namespace Database\Seeders;

use App\Enums\MapPinType;
use App\Models\MapPin;
use Illuminate\Database\Seeder;

class MapPinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            ['name' => 'Erbil Citadel', 'lat' => 36.1901, 'lng' => 44.0089],
            ['name' => 'Ankawa', 'lat' => 36.2290, 'lng' => 44.0163],
            ['name' => 'Ainkawa Park', 'lat' => 36.2215, 'lng' => 44.0250],
            ['name' => 'Sami Abdulrahman Park', 'lat' => 36.1980, 'lng' => 43.9930],
            ['name' => 'Erbil International Airport', 'lat' => 36.2376, 'lng' => 43.9632],
        ];

        foreach ($stations as $station) {
            MapPin::factory()->weatherStation()->create([
                'latitude' => $station['lat'],
                'longitude' => $station['lng'],
                'data' => [
                    'station_name' => $station['name'] . ' Weather Station',
                    'status' => 'active',
                    'last_reading' => rand(-5, 45) + rand(0, 9) / 10,
                ],
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
