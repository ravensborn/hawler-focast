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

it('returns the correct json structure with translations', function () {
    Notification::factory()->create();

    $this->getJson(route('notifications.index'))
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'icon',
                    'title' => ['en', 'ar', 'ku'],
                    'description' => ['en', 'ar', 'ku'],
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

it('returns all translations for translatable fields', function () {
    Notification::factory()->create([
        'title' => ['en' => 'English Title', 'ar' => 'عنوان عربي', 'ku' => 'ناونیشانی کوردی'],
        'description' => ['en' => 'English description', 'ar' => 'وصف عربي', 'ku' => 'وەسفی کوردی'],
    ]);

    $response = $this->getJson(route('notifications.index'))
        ->assertSuccessful();

    $notification = $response->json('data.0');

    expect($notification['title']['en'])->toBe('English Title')
        ->and($notification['title']['ar'])->toBe('عنوان عربي')
        ->and($notification['title']['ku'])->toBe('ناونیشانی کوردی')
        ->and($notification['description']['en'])->toBe('English description')
        ->and($notification['description']['ar'])->toBe('وصف عربي')
        ->and($notification['description']['ku'])->toBe('وەسفی کوردی');
});
