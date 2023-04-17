<?php

namespace App\Actions\KickStart;

use App\Interfaces\IAction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminAction implements IAction
{
    public static function make(...$data): bool
    {
        $email = $data[0] ?? null;
        $password = $data[1] ?? null;

        if (!$email
            || !$password
            || User::where('email', $email)->exists()
            || filter_var($email, FILTER_VALIDATE_EMAIL) === false
        ) {
            return false;
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $user->exists;
    }
}
