<?php

use App\Http\Livewire\Auth\Login;
use App\Domain\Users\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

test('guests can see the login page', function () {
    get('/login')
        ->assertStatus(200);
});

test('guest can log in', function () {
    $email = 'test@' . config('custom.domain');
    User::factory()->create([
        'email' => $email,
    ]);

    livewire(Login::class)
        ->set('email', $email)
        ->set('password', 'password')
        ->call('login');

    expect($email)->toBe(Auth::user()->email);
});

it('redirects when user logs in', function () {
    $user = User::factory()->create();

    $this->be($user)
        ->get(route('login'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

test('email is required', function () {
    livewire('auth.login')
        ->set('email', '')
        ->call('login')
        ->assertHasErrors(['email' => 'required']);
});

test('email is valid', function () {
    livewire('auth.login')
        ->set('email', 'test')
        ->call('login')
        ->assertHasErrors(['email' => 'email']);
});

test('is valid domain email', function () {
    livewire('auth.login')
        ->set('email', 'test@.com')
        ->call('login')
        ->assertHasErrors(['email' => 'regex']);
});

test('password is required', function () {
    livewire(Login::class)
        ->set('password', '')
        ->call('login')
        ->assertHasErrors(['password' => 'required']);
});

test('password is valid', function () {
    livewire('auth.login')
        ->set('password', '1234567')
        ->call('login')
        ->assertHasErrors(['password' => 'min']);
});

test('user can\'t login with invalid credentials', function () {
    $email = 'test@' . config('custom.domain');

    User::factory()->create([
        'email' => $email
    ]);

    livewire(Login::class)
        ->set('email', $email)
        ->set('password', 'passwor')
        ->call('login');

    expect(Auth::user())->toBeNull();

    livewire(Login::class)
        ->set('email', $email)
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect(RouteServiceProvider::HOME);

    expect(Auth::user())->toBeObject();
});
