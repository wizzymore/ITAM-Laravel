<?php

namespace Tests\Feature\Auth;

use App\Domain\Users\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

test('guest can see register page', function () {
    $this->get(route('register'))
        ->assertSuccessful();
});

/**
 * Test if a logged in user gets redirected to the dashboard
 *
 * @return void
 */
it('redirects logged in users', function () {
    $user = User::factory()->create();

    $this->be($user)
        ->get(route('register'))
        ->assertRedirect(RouteServiceProvider::HOME);
});

/**
 * Test if a guest can register
 *
 * @return void
 */
test('guests can register', function () {
    Event::fake();

    $email = 'bilucristian25@' . config('custom.domain');

    livewire('auth.register')
        ->set('name', 'Cristian Bilu')
        ->set('email', $email)
        ->set('password', 'password')
        ->set('passwordConfirmation', 'password')
        ->call('register')
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertTrue(User::where('email', $email)->exists());
    $this->assertEquals($email, Auth::user()->email);

    Event::assertDispatched(Registered::class);
});

test('name is required', function () {
    livewire('auth.register')
        ->set('name', '')
        ->call('register')
        ->assertHasErrors(['name' => 'required']);
});

test('email is required', function () {
    livewire('auth.register')
        ->set('email', '')
        ->call('register')
        ->assertHasErrors(['email' => 'required']);
});

test('password is required', function()
{
    livewire('auth.register')
        ->set('password', '')
        ->call('register')
        ->assertHasErrors(['password' => 'required']);
});

test('email is valid', function()
{
    livewire('auth.register')
        ->set('email', 'test')
        ->call('register')
        ->assertHasErrors(['email' => 'email']);
});

it('allows only domain email', function()
{
    livewire('auth.register')
        ->set('email', 'test@test.com')
        ->call('register')
        ->assertHasErrors(['email' => 'regex']);
});

it('doesn\'t allow taken emails', function()
{
    User::factory()->create(['email' => 'bilucristian25@ipsos.com']);

    livewire('auth.register')
        ->set('email', 'bilucristian25@ipsos.com')
        ->call('register')
        ->assertHasErrors(['email' => 'unique']);
});

test('test password validation', function()
{
    livewire('auth.register')
        ->set('password', '1')
        ->call('register')
        ->assertHasErrors(['password']);
});

test('password matches confirmation password', function()
{
    livewire('auth.register')
        ->set('password', 'password')
        ->set('passwordConfirmation', 'not-password')
        ->call('register')
        ->assertHasErrors(['password' => 'same']);
});
