<?php

use App\Enums\AlertType;
use App\Models\Alert;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns an empty list when no alerts exist', function () {
    $this->getJson(route('alerts.index'))
        ->assertSuccessful()
        ->assertJsonCount(0, 'data');
});

it('returns a list of alerts', function () {
    Alert::factory(3)->create();

    $this->getJson(route('alerts.index'))
        ->assertSuccessful()
        ->assertJsonCount(3, 'data');
});

it('returns alerts ordered by newest first', function () {
    $old = Alert::factory()->create(['created_at' => now()->subDay()]);
    $new = Alert::factory()->create(['created_at' => now()]);

    $response = $this->getJson(route('alerts.index'))
        ->assertSuccessful();

    $ids = collect($response->json('data'))->pluck('id');

    expect($ids->first())->toBe($new->id)
        ->and($ids->last())->toBe($old->id);
});

it('returns the correct json structure with translations', function () {
    Alert::factory()->create();

    $this->getJson(route('alerts.index'))
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

it('returns valid alert type values', function () {
    Alert::factory()->create(['type' => AlertType::Info]);
    Alert::factory()->create(['type' => AlertType::Warning]);
    Alert::factory()->create(['type' => AlertType::Danger]);

    $response = $this->getJson(route('alerts.index'))
        ->assertSuccessful();

    $types = collect($response->json('data'))->pluck('type')->unique()->values();

    expect($types->toArray())->each->toBeIn(AlertType::values());
});

it('does not require authentication', function () {
    $this->getJson(route('alerts.index'))
        ->assertSuccessful();
});

it('returns all translations for translatable fields', function () {
    Alert::factory()->create([
        'title' => ['en' => 'English Title', 'ar' => 'عنوان عربي', 'ku' => 'ناونیشانی کوردی'],
        'description' => ['en' => 'English description', 'ar' => 'وصف عربي', 'ku' => 'وەسفی کوردی'],
    ]);

    $response = $this->getJson(route('alerts.index'))
        ->assertSuccessful();

    $alert = $response->json('data.0');

    expect($alert['title']['en'])->toBe('English Title')
        ->and($alert['title']['ar'])->toBe('عنوان عربي')
        ->and($alert['title']['ku'])->toBe('ناونیشانی کوردی')
        ->and($alert['description']['en'])->toBe('English description')
        ->and($alert['description']['ar'])->toBe('وصف عربي')
        ->and($alert['description']['ku'])->toBe('وەسفی کوردی');
});
