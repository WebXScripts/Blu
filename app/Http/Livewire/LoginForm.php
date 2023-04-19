<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View as ViewContract;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class LoginForm extends Component
{
    use WireToast;

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
            Toast()->danger('Invalid credentials. Please try again.')
                ->push();
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
