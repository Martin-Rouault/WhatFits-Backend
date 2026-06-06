<?php

use App\Models\Build;
use App\Models\User;

test('a guest cannot like a build', function () {
    $build = Build::factory()->create();

    $this->postJson("/api/v1/builds/{$build->id}/like")->assertUnauthorized();
});

test('a user can like a build', function () {
    $user  = User::factory()->create();
    $build = Build::factory()->create();

    $response = $this->actingAs($user)->postJson("/api/v1/builds/{$build->id}/like");

    $response->assertOk();
    $response->assertJsonPath('liked', true);
    $response->assertJsonPath('likes_count', 1);
    $this->assertDatabaseHas('likes', [
        'user_id'       => $user->id,
        'likeable_id'   => $build->id,
        'likeable_type' => Build::class,
    ]);
});

test('a user can unlike a build they already liked', function () {
    $user  = User::factory()->create();
    $build = Build::factory()->create();

    $build->likes()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->postJson("/api/v1/builds/{$build->id}/like");

    $response->assertOk();
    $response->assertJsonPath('liked', false);
    $response->assertJsonPath('likes_count', 0);
    $this->assertDatabaseMissing('likes', [
        'user_id'     => $user->id,
        'likeable_id' => $build->id,
    ]);
});

test('liking a build twice only counts once', function () {
    $user  = User::factory()->create();
    $build = Build::factory()->create();

    $this->actingAs($user)->postJson("/api/v1/builds/{$build->id}/like");
    $this->actingAs($user)->postJson("/api/v1/builds/{$build->id}/like");

    $this->assertDatabaseCount('likes', 0);
});
