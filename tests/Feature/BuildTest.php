<?php

use App\Models\Build;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Wheel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

// ─── INDEX ────────────────────────────────────────────────────────────────────

test('anyone can see the builds feed', function () {
    Storage::fake('r2');

    Build::factory()
        ->has(\App\Models\BuildPhoto::factory()->count(2), 'photos')
        ->count(3)
        ->create();

    $response = $this->getJson('/api/v1/builds');

    $response->assertOk();
    $response->assertJsonCount(3, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'car_model' => ['id', 'name', 'make'],
                'wheel'     => ['id', 'name', 'brand'],
                'car_year',
                'diameter',
                'width',
                'likes_count',
                'photos' => [
                    '*' => ['url', 'order'],
                ],
            ],
        ],
    ]);
});

// ─── SHOW ─────────────────────────────────────────────────────────────────────

test('anyone can view a single build', function () {
    $build = Build::factory()->create();

    $response = $this->getJson("/api/v1/builds/{$build->id}");

    $response->assertOk();
    $response->assertJsonPath('data.id', $build->id);
});

test('returns 404 when build does not exist', function () {
    $this->getJson('/api/v1/builds/9999')->assertNotFound();
});

// ─── STORE ────────────────────────────────────────────────────────────────────

test('a guest cannot create a build', function () {
    $this->postJson('/api/v1/builds', [])->assertUnauthorized();
});

test('a user with unverified email cannot create a build', function () {
    $user     = User::factory()->unverified()->create();
    $carModel = CarModel::factory()->create();
    $wheel    = Wheel::factory()->create();

    Storage::fake('r2');

    $response = $this->actingAs($user)->postJson('/api/v1/builds', [
        'car_model_id' => $carModel->id,
        'wheel_id'     => $wheel->id,
        'car_year'     => 2020,
        'diameter'     => 18,
        'width'        => 8.5,
        'photos'       => [UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg')],
    ]);

    $response->assertForbidden();
});

test('a verified user can create a build', function () {
    Storage::fake('r2');

    $user     = User::factory()->create();
    $carModel = CarModel::factory()->create();
    $wheel    = Wheel::factory()->create();

    $response = $this->actingAs($user)->postJson('/api/v1/builds', [
        'car_model_id' => $carModel->id,
        'wheel_id'     => $wheel->id,
        'car_year'     => 2020,
        'diameter'     => 18,
        'width'        => 8.5,
        'photos'       => [UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg')],
    ]);

    $response->assertCreated();
    $this->assertDatabaseHas('builds', [
        'user_id'      => $user->id,
        'car_model_id' => $carModel->id,
        'wheel_id'     => $wheel->id,
    ]);
});

test('store rejects invalid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/api/v1/builds', [
        'car_model_id' => 9999,
        'wheel_id'     => 9999,
        'car_year'     => 1800,
        'diameter'     => 5,
        'width'        => 3.0,
    ]);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['car_model_id', 'wheel_id', 'car_year', 'diameter', 'width', 'photos']);
});

// ─── UPDATE ───────────────────────────────────────────────────────────────────

test('a guest cannot update a build', function () {
    $build = Build::factory()->create();

    $this->patchJson("/api/v1/builds/{$build->id}", [])->assertUnauthorized();
});

test('a user cannot update another user\'s build', function () {
    $build     = Build::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->patchJson("/api/v1/builds/{$build->id}", ['car_year' => 2021])
        ->assertForbidden();
});

test('a user can update their own build', function () {
    Storage::fake('r2');

    $user     = User::factory()->create();
    $build    = Build::factory()->for($user)->create();
    $newModel = CarModel::factory()->create();

    $response = $this->actingAs($user)->patchJson("/api/v1/builds/{$build->id}", [
        'car_model_id' => $newModel->id,
        'car_year'     => 2022,
    ]);

    $response->assertOk();
    $this->assertDatabaseHas('builds', [
        'id'           => $build->id,
        'car_model_id' => $newModel->id,
        'car_year'     => 2022,
    ]);
});

test('a user can add photos to their build', function () {
    Storage::fake('r2');

    $user  = User::factory()->create();
    $build = Build::factory()->for($user)->create();

    $response = $this->actingAs($user)->patchJson("/api/v1/builds/{$build->id}", [
        'add' => [UploadedFile::fake()->create('new.jpg', 100, 'image/jpeg')],
    ]);

    $response->assertOk();
    $this->assertDatabaseCount('build_photos', 1);
});

test('a user can reorder photos of their build', function () {
    Storage::fake('r2');

    $user  = User::factory()->create();
    $build = Build::factory()->for($user)->create();

    $photo1 = \App\Models\BuildPhoto::factory()->for($build)->create(['display_order' => 0]);
    $photo2 = \App\Models\BuildPhoto::factory()->for($build)->create(['display_order' => 1]);

    $this->actingAs($user)->patchJson("/api/v1/builds/{$build->id}", [
        'reorder' => [$photo2->id, $photo1->id],
    ])->assertOk();

    $this->assertDatabaseHas('build_photos', ['id' => $photo2->id, 'display_order' => 0]);
    $this->assertDatabaseHas('build_photos', ['id' => $photo1->id, 'display_order' => 1]);
});

test('a user can delete a photo from their build', function () {
    Storage::fake('r2');

    $user  = User::factory()->create();
    $build = Build::factory()->for($user)->create();
    $photo = \App\Models\BuildPhoto::factory()->for($build)->create();

    $response = $this->actingAs($user)->patchJson("/api/v1/builds/{$build->id}", [
        'delete' => [$photo->id],
    ]);

    $response->assertOk();
    $this->assertDatabaseMissing('build_photos', ['id' => $photo->id]);
});

// ─── DESTROY ──────────────────────────────────────────────────────────────────

test('a guest cannot delete a build', function () {
    $build = Build::factory()->create();

    $this->deleteJson("/api/v1/builds/{$build->id}")->assertUnauthorized();
});

test('a user cannot delete another user\'s build', function () {
    $build     = Build::factory()->create();
    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)
        ->deleteJson("/api/v1/builds/{$build->id}")
        ->assertForbidden();
});

test('a user can delete their own build', function () {
    Storage::fake('r2');

    $user  = User::factory()->create();
    $build = Build::factory()->for($user)->create();

    $this->actingAs($user)
        ->deleteJson("/api/v1/builds/{$build->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('builds', ['id' => $build->id]);
});
