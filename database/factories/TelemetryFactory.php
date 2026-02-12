<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Telemetry>
 */
class TelemetryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sensor_device_id' => null,
            'sensor_parameter_id' => null,
            'value' => fake()->randomFloat(2, 0, 100),
            'created_at' => fake()->dateTimeBetween('today', 'now'),
            'updated_at' => fake()->dateTimeBetween('today', 'now'),
        ];
    }
}
