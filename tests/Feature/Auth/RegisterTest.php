<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a guest user can see the register page
     *
     * @return void
     */
    public function test_can_see_register_route_as_guest()
    {
        $this->get(route('register'))
            ->assertSuccessful();
    }

    /**
     * Test if a logged in user gets redirected to the dashboard
     * 
     * @return void
     */
    public function test_is_redirected_if_logged_in()
    {
        $user = User::factory()->create();

        $this->be($user)
            ->get(route('register'))
            ->assertRedirect(route('dashboard'));
    }

    /**
     * Test if a guest can register
     * 
     * @return void
     */
    public function test_guest_can_register()
    {
        Event::fake();

        $email = 'bilucristian25@ipsos.com';

        Livewire::test('auth.register')
            ->set('name', 'Cristian Bilu')
            ->set('email', $email)
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertRedirect(route('dashboard'));

        $this->assertTrue(User::where('email', $email)->exists());
        $this->assertEquals($email, Auth::user()->email);

        Event::assertDispatched(Registered::class);
    }

    public function test_name_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', '')
            ->call('register')
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_email_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', '')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_email_is_valid()
    {
        Livewire::test('auth.register')
            ->set('email', 'test')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    public function test_check_for_valid_ipsos_email()
    {
        Livewire::test('auth.register')
            ->set('email', 'test@test.com')
            ->call('register')
            ->assertHasErrors(['email' => 'regex']);
    }

    public function test_email_was_not_taken()
    {
        User::factory()->create(['email' => 'bilucristian25@ipsos.com']);

        Livewire::test('auth.register')
            ->set('email', 'bilucristian25@ipsos.com')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    function test_email_already_taken_validation_message_shown_as_user_types()
    {
        User::factory()->create(['email' => 'bilucristian25@ipsos.com']);

        Livewire::test('auth.register')
            ->set('email', 'vasile.potcovaru@ipsos.com')
            ->assertHasNoErrors()
            ->set('email', 'bilucristian25@ipsos.com')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    function test_password_is_required()
    {
        Livewire::test('auth.register')
            ->set('password', '')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    function test_password_is_minimum_eight_characters()
    {
        Livewire::test('auth.register')
            ->set('password', '1234567')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    function test_password_matches_confirmation_password()
    {
        Livewire::test('auth.register')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'not-password')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
