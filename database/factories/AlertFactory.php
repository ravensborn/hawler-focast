<?php

namespace Database\Factories;

use App\Enums\AlertType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alert>
 */
class AlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => fake()->randomElement(['info', 'warning', 'alert', 'bell', 'check']),
            'title' => [
                'en' => fake()->sentence(3),
                'ar' => fake()->sentence(3),
                'ku' => fake()->sentence(3),
            ],
            'description' => [
                'en' => fake()->paragraph(),
                'ar' => fake()->paragraph(),
                'ku' => fake()->paragraph(),
            ],
            'type' => fake()->randomElement(AlertType::values()),
        ];
    }
}
