<?php

use App\Mail\MagicLoginLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('ensures the email address is valid', function () {
    $this->post('auth/login', [
        'email' => 'nope'
    ])->assertSessionHasErrors(['email']);
});

it('ensures the email address exists', function () {
    $this->post('auth/login', [
        'email' => 'john@example.com'
    ])->assertSessionHasErrors(['email']);
});

it('sends a magic link email', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('auth/login', [
       'email' => $user->email
    ])->assertSessionHas('success');

    Mail::assertQueued(function (MagicLoginLink $mail) use ($user) {
        return $mail->hasTo($user->email) &&
            $mail->hasSubject('Magic Login Link');
    });
});

