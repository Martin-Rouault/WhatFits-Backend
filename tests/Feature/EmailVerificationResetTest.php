<?php

// EMAIL VERIFICATION

use App\Models\User;
use Illuminate\Support\Facades\URL;

use function Pest\Laravel\getJson;

// VERIFY EMAIL
test('verify email with a valid hash and a non verified user returns 200', function () {

    $user = User::factory()->unverified()->create();

    $url = URL::signedRoute('verification.verify', [
        'id' => $user->id,
        'hash' => sha1($user->email)
    ]);

    $response = getJson($url);

    $response->assertStatus(200);
});


test('verify email with incorrect signed url returns 422', function () {

    $user = User::factory()->unverified()->create();

    $url = "/api/v1/email/verify/{$user->id}/" . sha1($user->email);

    $response = getJson($url);

    $response->assertStatus(422);
});

test('verify email with a user already verified returns 400', function () {

    $user = User::factory()->create();

    $url = URL::signedRoute('verification.verify', [
        'id' => $user->id,
        'hash' => sha1($user->email)
    ]);

    $response = getJson($url);

    $response->assertStatus(400);
});
