<?php

namespace App\Casts\User;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class PasswordHashCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): string
    {
        return $value;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return Hash::make($value);
    }
}
