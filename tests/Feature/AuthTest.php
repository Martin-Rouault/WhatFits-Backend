<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

// LOGIN
test('the login method returns a user and a 200 status code', function () {
    /** @var \Tests\TestCase $this */

    $password = "TotoLastico92";

    $user = User::factory()->create([
        'password' => $password
    ]);

    $response = $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => $password
    ], ['Referer' => 'http://localhost']);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'user' => [
            'id',
            'name',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at'
        ]
    ]);
    $this->assertAuthenticatedAs($user);
});

test('the login method should return a 401 status code when credentials are note valid ', function () {
    /** @var \Tests\TestCase $this */

    $password = "TotoLastico92";

    $user = User::factory()->create([
        'password' => $password
    ]);

    $response = $this->postJson('/api/v1/login', [
        'email' => $user->email,
        'password' => "wrong_password"
    ], ['Referer' => 'http://localhost']);

    $response->assertUnauthorized();
});


test('the login method return a 422 response if one of the credentials is not being sent', function () {
    /** @var \Tests\TestCase $this */

    $response = $this->postJson('/api/v1/login', [], ['Referer' => 'http://localhost']);

    $response->assertStatus(422);
});

//LOGOUT
test('On success, the logout method return a 204 code status', function () {
    /** @var \Tests\TestCase $this */

    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->postJson('/api/v1/logout', [], ['Referer' => 'http://localhost']);

    $response->assertStatus(204);
    $this->assertGuest('web');
});

//LOGOUT
test('If the user is not connected, the logout method return a 401 code status', function () {
    /** @var \Tests\TestCase $this */

    $response = $this->postJson('/api/v1/logout', [], ['Referer' => 'http://localhost']);

    $response->assertUnauthorized();
});

//REGISTER
test('the register method returns a user and a 201 status code', function () {
    /** @var \Tests\TestCase $this */

    $password = "TotoLastico92TutuLastica93";

    $response = $this->postJson('/api/v1/register', [
        'name' => "nitram",
        'email' => "martin@gmail.com",
        'password' => $password
    ], ['Referer' => 'http://localhost']);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'user' => [
            'id',
            'name',
            'email',
            'created_at',
            'updated_at'
        ]
    ]);
});

//REGISTER
test('If the mail is already taken, the register method returns a 422 status code', function () {
    /** @var \Tests\TestCase $this */

    User::factory()->create([
        'email' => 'martin@gmail.com'
    ]);

    $password = "TotoLastico92TutuLastica93";

    $response = $this->postJson('/api/v1/register', [
        'name' => "toto",
        'email' => "martin@gmail.com",
        'password' => $password
    ], ['Referer' => 'http://localhost']);

    $response->assertStatus(422);
});

//REGISTER
test('If the password is too short, the register method returns a 422 status code', function () {
    /** @var \Tests\TestCase $this */

    $password = "TotoLastico";

    $response = $this->postJson('/api/v1/register', [
        'name' => "toto",
        'email' => "martin@gmail.com",
        'password' => $password
    ], ['Referer' => 'http://localhost']);

    $response->assertStatus(422);
});
