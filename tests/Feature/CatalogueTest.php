<?php

use App\Models\CarModel;
use App\Models\Make;
use App\Models\Wheel;
use App\Models\WheelBrand;

// ─── MAKES ────────────────────────────────────────────────────────────────────

test('anyone can list makes', function () {
    Make::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/makes');

    $response->assertOk();
    $response->assertJsonCount(3);
    $response->assertJsonStructure([['id', 'name']]);
});

test('anyone can list car models for a make', function () {
    $make = Make::factory()->create();
    CarModel::factory()->count(2)->for($make)->create();

    $response = $this->getJson("/api/v1/makes/{$make->id}/car-models");

    $response->assertOk();
    $response->assertJsonCount(2);
    $response->assertJsonStructure([['id', 'name']]);
});

test('car models endpoint returns 404 for unknown make', function () {
    $this->getJson('/api/v1/makes/9999/car-models')->assertNotFound();
});

// ─── WHEEL BRANDS ─────────────────────────────────────────────────────────────

test('anyone can list wheel brands', function () {
    WheelBrand::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/wheel-brands');

    $response->assertOk();
    $response->assertJsonCount(3);
    $response->assertJsonStructure([['id', 'name']]);
});

test('anyone can list wheels for a wheel brand', function () {
    $brand = WheelBrand::factory()->create();
    Wheel::factory()->count(2)->for($brand, 'wheel_brand')->create();

    $response = $this->getJson("/api/v1/wheel-brands/{$brand->id}/wheels");

    $response->assertOk();
    $response->assertJsonCount(2);
    $response->assertJsonStructure([['id', 'name']]);
});

test('wheels endpoint returns 404 for unknown brand', function () {
    $this->getJson('/api/v1/wheel-brands/9999/wheels')->assertNotFound();
});
