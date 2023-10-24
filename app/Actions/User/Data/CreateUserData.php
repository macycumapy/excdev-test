<?php

declare(strict_types=1);

namespace App\Actions\User\Data;

use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public string $name;
    public string $email;
    public string $password;

    public static function rules(...$args): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }
}
