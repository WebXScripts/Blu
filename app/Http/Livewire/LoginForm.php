<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View as ViewContract;
use Livewire\Component;

class LoginForm extends Component
{
    public string $email = '';
    public string $password = '';

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function handle(): void
    {
        $this->validate();
        if (!auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', 'The provided credentials do not match our records.');
            return;
        }

        redirect()->route('dashboard');
    }

    public function render(): ViewContract
    {
        return view('livewire.login-form')
            ->extends('layouts.app')
            ->section('content');
    }
}
