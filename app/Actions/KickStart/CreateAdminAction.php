<?php

namespace App\Actions\KickStart;

use App\Models\User;

class CreateAdminAction
{
    public static function handle(string $email, string $password): bool
    {
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
            'password' => $password,
        ]);

        return $user->exists;
    }
}
