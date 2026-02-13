<?php

namespace Database\Factories;

use App\Enums\NotificationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
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
            'type' => fake()->randomElement(NotificationType::values()),
        ];
    }
}
