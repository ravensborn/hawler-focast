<?php

use App\Enums\NotificationType;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns an empty list when no notifications exist', function () {
    $this->getJson(route('notifications.index'))
        ->assertSuccessful()
        ->assertJsonCount(0, 'data');
});

it('returns a list of notifications', function () {
    Notification::factory(3)->create();

    $this->getJson(route('notifications.index'))
        ->assertSuccessful()
        ->assertJsonCount(3, 'data');
});

it('returns notifications ordered by newest first', function () {
    $old = Notification::factory()->create(['created_at' => now()->subDay()]);
    $new = Notification::factory()->create(['created_at' => now()]);

    $response = $this->getJson(route('notifications.index'))
        ->assertSuccessful();

    $ids = collect($response->json('data'))->pluck('id');

    expect($ids->first())->toBe($new->id)
        ->and($ids->last())->toBe($old->id);
});

it('returns the correct json structure', function () {
    Notification::factory()->create();

    $this->getJson(route('notifications.index'))
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'icon',
                    'title',
                    'description',
                    'type',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
});

it('returns valid notification type values', function () {
    Notification::factory()->create(['type' => NotificationType::Info]);
    Notification::factory()->create(['type' => NotificationType::Warning]);
    Notification::factory()->create(['type' => NotificationType::Danger]);

    $response = $this->getJson(route('notifications.index'))
        ->assertSuccessful();

    $types = collect($response->json('data'))->pluck('type')->unique()->values();

    expect($types->toArray())->each->toBeIn(NotificationType::values());
});

it('does not require authentication', function () {
    $this->getJson(route('notifications.index'))
        ->assertSuccessful();
});
