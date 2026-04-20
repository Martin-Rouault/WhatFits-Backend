<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

// FORGOT PASSWORD
test('forgot password with existing email returns 200', function () {

    Notification::fake();

    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/forgot-password', [
        'email' => $user->email
    ]);

    $response->assertStatus(200);
    Notification::assertSentTo($user, ResetPassword::class);
});

test('forgot password with unknown email also returns 200', function () {

    Notification::fake();

    $response = $this->postJson('/api/v1/forgot-password', [
        'email' => "unknown@gmail.com"
    ]);

    $response->assertStatus(200);
    Notification::assertNothingSent();
});

// RESET PASSWORD
test('reset password with valid token returns 200 and updates passowrd', function () {

    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->postJson("/api/v1/reset-password/{$token}", [
        'email' => $user->email,
        'password' => 'TotoLastico24Tutu',
        'password_confirmation' => 'TotoLastico24Tutu',
        'token' => $token
    ]);

    $response->assertStatus(200);
    expect(Hash::check('TotoLastico24Tutu', $user->fresh()->password))->toBeTrue();
});


test('reset password with valid token returns 200 and updates passowrd', function () {

    $user = User::factory()->create();
    $token = Password::createToken($user);

    $response = $this->postJson("/api/v1/reset-password/{$token}", [
        'email' => $user->email,
        'password' => 'TotoLastico24Tutu',
        'password_confirmation' => 'TotoLastico24Tutu',
        'token' => $token
    ]);

    $response->assertStatus(200);
    expect(Hash::check('TotoLastico24Tutu', $user->fresh()->password))->toBeTrue();
});
