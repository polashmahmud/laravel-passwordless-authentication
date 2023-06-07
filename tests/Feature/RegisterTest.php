<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('ensure the name field is required')
    ->post('auth/register', ['name' => ''])
    ->assertSessionHasErrors(['name']);;

it('ensure the email field is required')
    ->post('auth/register', ['email' => ''])
    ->assertSessionHasErrors(['email']);;

it('ensure the email address does nto exist already', function () {
    $user = User::factory()->create(['email' => 'john@example.com']);

    $this->post('auth/register', [
        'name' => 'John',
        'email' => $user->email
    ])->assertSessionHasErrors(['email']);
});

it('ensure register a user and send a Magic link', function () {
    Mail::fake();

    $this->post('auth/register', [
        'name' => $name = 'Polash Mahmud',
        'email' => $email = 'polashmahmud@gmail.com'
    ]);

    $this->assertDatabaseCount(User::class, 1);

    $this->assertDatabaseHas(User::class, [
        'name' => $name,
        'email' => $email
    ]);

    Mail::assertQueued(function (\App\Mail\MagicLoginLink $mail) use ($email) {
       return $mail->hasTo($email) &&
       $mail->hasSubject('Magic Login Link');
    });
});
