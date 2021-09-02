<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @return void */
    public function test_can_see_login_route_as_guest()
    {
        $this->get(route('login'))
            ->assertSuccessful()
            ->assertSeeLivewire('auth.login');
    }

    /** @return void */
    public function test_is_redirected_if_logged_in()
    {
        $user = User::factory()->create();

        $this->be($user)
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }

    /** @return void */
    public function test_guest_can_login()
    {
        $email = 'test@' . env('ITAM_EMAIL_DOMAIN', 'gmail.com');
        User::factory()->create([
            'email' => $email,
            'password' => Hash::make('password'),
        ]);

        Livewire::test('auth.login')
            ->set('email', $email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('dashboard'));

        $this->assertEquals($email, Auth::user()->email);
    }

    /** @return void */
    public function test_email_is_required()
    {
        Livewire::test('auth.login')
            ->set('email', '')
            ->call('login')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @return void */
    public function test_email_is_valid()
    {
        Livewire::test('auth.login')
            ->set('email', 'test')
            ->call('login')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @return void */
    public function test_email_is_valid_ipsos_email()
    {
        Livewire::test('auth.login')
            ->set('email', 'test@.com')
            ->call('login')
            ->assertHasErrors(['email' => 'regex']);
    }

    /** @return void */
    public function test_password_is_required()
    {
        Livewire::test('auth.login')
            ->set('password', '')
            ->call('login')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @return void */
    public function test_password_is_minimum_eight_characters()
    {
        Livewire::test('auth.login')
            ->set('password', '1234567')
            ->call('login')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @return void */
    public function test_error_on_invalid_credentials()
    {
        $email = 'test@' . env('ITAM_EMAIL_DOMAIN', 'gmail.com');

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make('password')
        ]);

        Livewire::test('auth.login')
            ->set('email', $email)
            ->set('password', 'passwor')
            ->call('login');

        $this->assertNull(Auth::user());

        Livewire::test('auth.login')
            ->set('email', $email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect(route('dashboard'));

        $this->assertEquals($email, Auth::user()->email);
    }
}
