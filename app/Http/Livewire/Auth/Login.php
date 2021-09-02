<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email|regex:/^.*@' . env('ITAM_EMAIL_DOMAIN', 'gmail.com') . '$/',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password,], true)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
